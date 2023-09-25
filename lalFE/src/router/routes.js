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
    meta: {
      requireAuth: true,
    },
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
    meta: {
      requireAuth: true,
    },
  },
  {
    path: "/login",
    component: () => import("layouts/DashboardLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("src/pages/Forms/LoginPage.vue"),
      },
    ],
    meta: {
      login: true,
    },
  },
  {
    path: "/register",
    component: () => import("layouts/DashboardLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("src/pages/Forms/RegisterPage.vue"),
      },
    ],
    meta: {
      login: true,
    },
  },
  {
    path: "/add-story",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("src/pages/Forms/UploadStory.vue"),
      },
    ],
    meta: {
      requireAuth: true,
    },
  },
  {
    path: "/player",
    component: () => import("layouts/PlayerLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("src/pages/Others/AudioPlayerPage.vue"),
      },
    ],
  },
  {
    path: "/test",
    component: () => import("layouts/EmptyLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("src/pages/Others/VideoJs.vue"),
      },
    ],
  },

  {
    path: "/:catchAll(.*)*",
    component: () => import("src/pages/Others/ErrorNotFound.vue"),
  },
];

export default routes;
