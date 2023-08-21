import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css'; 
import { createApp } from "vue";
import { createStore } from "vuex";
const store = createStore({
    state() {
        return {
            item: {},
            process: {
                message: "",
                data: "",
            },
        };
    },
});

const app = createApp({});
app.use(store);

import HomeComponent from "./components/Home.vue";
import AddressForm from "./components/AddressForm.vue";
import AddressList from "./components/AddressList.vue";
import Alert from "./components/Alert.vue";
import Modal from './components/Modal.vue';

app.component("Home", HomeComponent);
app.component("AddressForm", AddressForm);
app.component("AddressList", AddressList);
app.component("Modal",Modal);
app.component("Alert", Alert);
app.mount("#app");
