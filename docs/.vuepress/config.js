module.exports = {
  sidebar: true,
  base: "/laravel-packer/",
  title: "Laravel Packer",
  sidebar: true,
  themeConfig: {
    repo: "bitfumes/laravel-packer",
    sidebar: [
      {
        title: "Get Started",
        collapsable: false,
        path: "/installation"
      },
      {
        title: "Artisan Commands",
        path: "/artisan",
        collapsable: true
      },
      {
        title: "Crud Generator",
        path: "/crud",
        collapsable: true
      },
      {
        title: "Smart Clone",
        path: "/clone",
        collapsable: true
      },
      "/support"
    ],
    repoLabel: "Github",
    docsDir: "docs",
    docsBranch: "master",
    editLinks: true,
    editLinkText: "Help us improve this page!",
    smoothScroll: true
  }
};
