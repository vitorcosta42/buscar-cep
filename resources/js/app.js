import "./bootstrap";
import { createApp } from "vue";
import { createStore } from "vuex";
const store = createStore({
    state() {
        return {
            item: {},
            processo: {
                mensagem: "",
                dados: "",
            },
        };
    },
});

const app = createApp({});
app.use(store);
import HomeComponent from "./components/Home.vue";
import SearchForm from "./components/SearchForm.vue"
app.component("Home", HomeComponent);
app.component("SearchForm", SearchForm);
app.mount("#app");
