{ pkgs ? import <nixpkgs> {} }:
pkgs.buildEnv {
  name = "laravel-env";
  paths = [
    pkgs.php82
    pkgs.php82Packages.composer
    pkgs.nodejs-18_x
    pkgs.pnpm
  ];
  ignoreCollisions = true;  # <-- Solution clé
}
