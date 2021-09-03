<?php

namespace App\Services;

use Illuminate\Routing\RouteCollection;

class RouteService
{
    static private RouteCollection $allRoutes;
    static private ?array $calculatedRoutes = null;

    public static function routes(): RouteService
    {
        self::$allRoutes = \Route::getRoutes();

        return new static();
    }

    public static function nameStartsWith(string $startsWith): RouteService
    {
        if (self::$calculatedRoutes !== null) {

            $index = 0;

            foreach (self::$calculatedRoutes as $route) {

                if (!str_starts_with($route->getName(), $startsWith)) {
                    unset(self::$calculatedRoutes[$index]);
                }

                $index++;
            }

            self::$calculatedRoutes = array_values(self::$calculatedRoutes);
        } else {

            $routes = self::$allRoutes->getRoutesByName();

            foreach (array_keys($routes) as $route) {

                if (str_starts_with($route, $startsWith)) {
                    self::$calculatedRoutes[] = $routes[$route];
                }
            }
        }

        return new static();
    }

    public static function withoutParameter(): RouteService
    {
        if (self::$calculatedRoutes !== null) {

            $index = 0;

            foreach (self::$calculatedRoutes as $route) {

                if (str_contains($route->uri, '{')) {
                    unset(self::$calculatedRoutes[$index]);
                }

                $index++;
            }

            self::$calculatedRoutes = array_values(self::$calculatedRoutes);
        } else {

            $routes = self::$allRoutes->getRoutesByName();

            foreach ($routes as $route) {

                if (!str_contains($route->uri, '{')) {
                    self::$calculatedRoutes[] = $route;
                }
            }
        }

        return new static();
    }

    public static function method(string $method): RouteService
    {
        $method = strtoupper($method);

        if (self::$calculatedRoutes !== null) {

            $index = 0;
            foreach (self::$calculatedRoutes as $route) {

                if (!in_array($method, $route->methods())) {
                    unset(self::$calculatedRoutes[$index]);
                }

                $index++;
            }

            self::$calculatedRoutes = array_values(self::$calculatedRoutes);
        } else {
            foreach (self::$allRoutes->getRoutesByMethod()[$method] as $route) {
                self::$calculatedRoutes[] = $route;
            }
        }

        return new static();
    }

    public static function get(): array
    {
        $routes = [];

        foreach (self::$calculatedRoutes as $route) {
            $routes[] = $route->uri;
        }

        return $routes;
    }
}
