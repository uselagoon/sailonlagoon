<?php

use Symfony\Component\Yaml\Yaml;
use Uselagoon\Sailonlagoon\Commands\SailonlagoonCommand;
use function Illuminate\Filesystem\join_paths;

/**
 * This file contains tests for the static function SailonlagoonCommand:prioritizeOrder
 */


it("should properly sort using prioritizeOrder", function () {
    $unordered = collect(["z", "f", "a"]);
    $order = collect(["a"]); //we only worry about if "a" is first
    /** @var \Ramsey\Collection\Collection $ret */
    $ret = SailonlagoonCommand::prioritizeOrder($order, $unordered);
    expect($ret->first())->toEqual("a");
});

it("should maintain relative order for items not in the order list using prioritizeOrder", function () {
    $unordered = collect(["z", "f", "a", "c", "b"]);
    $order = collect(["a", "b", "c"]);
    /** @var \Illuminate\Support\Collection $ret */
    $ret = SailonlagoonCommand::prioritizeOrder($order, $unordered);

// Ordered items must be at the beginning and in the correct order
    expect($ret->slice(0, 3)->values()->all())->toEqual(["a", "b", "c"]);

// Remaining elements should appear in any order but must still be present
    expect($ret->contains("z"))->toBeTrue();
    expect($ret->contains("f"))->toBeTrue();
});

it("should handle an empty toBeSorted collection using prioritizeOrder", function () {
    $unordered = collect([]);
    $order = collect(["a", "b", "c"]);
    /** @var \Illuminate\Support\Collection $ret */
    $ret = SailonlagoonCommand::prioritizeOrder($order, $unordered);

    expect($ret->isEmpty())->toBeTrue();
});

it("should handle an empty order collection using prioritizeOrder", function () {
    $unordered = collect(["x", "y", "z"]);
    $order = collect([]);
    /** @var \Illuminate\Support\Collection $ret */
    $ret = SailonlagoonCommand::prioritizeOrder($order, $unordered);

    expect($ret->all())->toEqual(["x", "y", "z"]); // Should maintain original order
});

it("should handle an order collection with elements not in toBeSorted using prioritizeOrder", function () {
    $unordered = collect(["x", "y", "z"]);
    $order = collect(["a", "b", "c"]);
    /** @var \Illuminate\Support\Collection $ret */
    $ret = SailonlagoonCommand::prioritizeOrder($order, $unordered);

    expect($ret->all())->toEqual(["x", "y", "z"]); // Since none match, order stays the same
});

it("should properly handle duplicate values in toBeSorted using prioritizeOrder", function () {
    $unordered = collect(["c", "a", "b", "a", "c", "b"]);
    $order = collect(["a", "b", "c"]);
    /** @var \Illuminate\Support\Collection $ret */
    $ret = SailonlagoonCommand::prioritizeOrder($order, $unordered);

    expect($ret->all())->toEqual(["a", "a", "b", "b", "c", "c"]);
});


it("should return the same list if toBeSorted is already ordered correctly using prioritizeOrder", function () {
    $unordered = collect(["a", "b", "c", "x", "y", "z"]);
    $order = collect(["a", "b", "c"]);
    /** @var \Illuminate\Support\Collection $ret */
    $ret = SailonlagoonCommand::prioritizeOrder($order, $unordered);

    expect($ret->all())->toEqual(["a", "b", "c", "x", "y", "z"]);
});

