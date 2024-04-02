<?php


use Symfony\Component\Yaml\Yaml;
use Uselagoon\Sailinglagoon\Commands\SailinglagoonCommand;
use function Illuminate\Filesystem\join_paths;

it('will allow us to remove unused services', function () {
    $sailingLagoonCommand = new SailinglagoonCommand();

    $serviceList = collect(["cli", "php", "mariadb"]);
    $services = [
      "first" => [
          "depends_on" => ["cli", "php", "shouldntexist"]
      ]
    ];

    $newServices = $sailingLagoonCommand->removeUnusedServiceDependencies($services, $serviceList);

    expect($newServices["first"]["depends_on"])->not()->toContain("shouldntexist");
    expect($newServices["first"]["depends_on"])->toContain("cli");
});

it("should successfully generate a docker-compose.yaml given stubs", function() {
    $sailingLagoonCommand = new SailinglagoonCommand();
    $serviceList = collect(["cli", "mariadb"]);
    $yamlFile = file_get_contents(join_paths(__DIR__, "assets/stubs", "docker-compose.stub"));
    $dockerCompose = $sailingLagoonCommand->generateDockerCompose($serviceList,
        join_paths(__DIR__, "assets/stubs"), $yamlFile);

    $yamlOutput = Yaml::dump($dockerCompose, 5);
    expect($yamlOutput)->toContain("cli")->toContain("mariadb")->not()->toContain("php");

});
