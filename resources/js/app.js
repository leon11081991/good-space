import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import MainLayout from "@/Layouts/MainLayout.vue";
import { ZiggyVue } from "ziggy";
import { InertiaProgress } from "@inertiajs/progress";
import "../css/app.css";

InertiaProgress.init({
  delay: 0,
  color: "#29d",
  includeCSS: true,
  showSpinner: true,
});

createInertiaApp({
  resolve: async (name) => {
    // * 下面的程式碼 page會出現undefined 找不到.default
    //const pages = import.meta.glob("./Pages/**/*.vue");
    //const page = await pages[`./Pages/${name}.vue`];
    //page.default.layout = page.default?.layout || MainLayout;
    //return page;

    const page = await resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob("./Pages/**/*.vue")
    );
    page.default.layout ??= MainLayout;
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .mount(el);
  },
});
