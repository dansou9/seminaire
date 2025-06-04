{ pkgs ? import <nixpkgs> {} }:
pkgs.buildEnv {
  name = "laravel-env";
  paths = [
    pkgs.php82
    pkgs.php82Packages.composer
    pkgs.nodejs-18_x
    pkgs.nodePackages.npm  # <-- Utilise npm explicitement
  ];
  ignoreCollisions = true;  # Sécurité supplémentaire
}
