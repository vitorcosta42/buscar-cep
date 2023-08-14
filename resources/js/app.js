import "./bootstrap";
import { createApp } from "vue";
import { createStore } from "vuex";
const store = createStore({
    state() {
        return {
            item: {},
            transacao: {
                mensagem: "",
                dados: "",
            },
        };
    },
});

const app = createApp({});
app.use(store);
import HomeComponent from "./components/Home.vue";

app.component("Home", HomeComponent);
app.mount("#app");
