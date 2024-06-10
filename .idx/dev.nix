{pkgs}: {
  channel = "stable-23.11";
  packages = [
    pkgs.nodejs_20
    pkgs.php81
    pkgs.php81Packages.composer
  ];
  idx.extensions = [
    "svelte.svelte-vscode"
    "vue.volar"
    
    
  ];
  idx.previews = {
    previews = {
      web = {
        command = [
          "npm"
          "run"
          "dev"
          "--"
          "--port"
          "$PORT"
          "--host"
          "0.0.0.0"
          "php"
          "artisan"
          "key:generate"
          "composer"
          "install"
          "--seed"
          "migrate"
          "migrate:fresh"
        ];
        manager = "web";
      };
    };
  };
}