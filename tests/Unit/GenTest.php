<?php


use Symfony\Component\Yaml\Yaml;
use Uselagoon\Sailonlagoon\Commands\SailonlagoonCommand;
use function Illuminate\Filesystem\join_paths;

it('will allow us to remove unused services', function () {
    $sailonLagoonCommand = new SailonlagoonCommand();

    $serviceList = collect(["cli", "php", "mariadb"]);
    $services = [
        "first" => [
            "depends_on" => ["cli", "php", "shouldntexist"]
        ]
    ];

    $newServices = $sailonLagoonCommand->removeUnusedServiceDependencies($services, $serviceList);

    expect($newServices["first"]["depends_on"])->not()->toContain("shouldntexist");
    expect($newServices["first"]["depends_on"])->toContain("cli");
});

it("should successfully generate a docker-compose.yaml given stubs", function () {
    $sailonLagoonCommand = new SailonlagoonCommand();
    $serviceList = collect(["cli", "mariadb"]);
    $yamlFile = file_get_contents(join_paths(__DIR__, "assets/stubs", "docker-compose.stub"));
    $dockerCompose = $sailonLagoonCommand->generateDockerCompose($serviceList,
        join_paths(__DIR__, "assets/stubs"), $yamlFile);

    $yamlOutput = Yaml::dump($dockerCompose, 5);
    expect($yamlOutput)->toContain("cli")->toContain("mariadb")->not()->toContain("php");
});

it("should order the services in the docker-compose.yaml in the correct order", function () {
    $sailonLagoonCommand = new SailonlagoonCommand();
    $serviceList = collect(["php", "cli", "nginx"]);
    $yamlFile = file_get_contents(join_paths(__DIR__, "assets/stubs", "docker-compose.stub"));
    $dockerCompose = $sailonLagoonCommand->generateDockerCompose($serviceList,
        join_paths(__DIR__, "assets/stubs"), $yamlFile);

    expect(array_keys($dockerCompose['services']))->toEqual(['cli', 'nginx', 'php']);
});
