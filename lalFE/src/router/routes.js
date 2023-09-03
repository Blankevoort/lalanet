const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("src/pages/Main Pages/IndexPage.vue"),
      },
    ],
  },
  {
    path: "/intro",
    component: () => import("layouts/EmptyLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("src/pages/Main Pages/IntroPage.vue"),
      },
    ],
  },
  {
    path: "/all-lalaies",
    component: () => import("layouts/LalaiesLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("src/pages/Main Pages/showAllLalaies.vue"),
      },
    ],
  },
  {
    path: "/all-stories",
    component: () => import("layouts/StoriesLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("src/pages/Main Pages/showAllStories.vue"),
      },
    ],
    // meta: {
    //   requireAuth: true,
    // },
  },
  {
    path: "/player",
    component: () => import("src/layouts/PlayerLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("src/pages/Others/AudioPlayerPage.vue"),
      },
    ],
  },
  {
    path: "/upload",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("src/pages/Main Pages/UploadStory.vue"),
      },
    ],
    // meta: {
    //   requireAuth: true,
    // },
  },
  {
    path: "/dashboard",
    component: () => import("layouts/DashboardLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("src/pages/Main Pages/DashboardPage.vue"),
      },
    ],
    // meta: {
    //   requireAuth: true,
    // },
  },

  {
    path: "/:catchAll(.*)*",
    component: () => import("src/pages/Others/ErrorNotFound.vue"),
  },
];

export default routes;
