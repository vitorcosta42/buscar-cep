import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
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

import Address from "./components/Address.vue";
import AddressForm from "./components/AddressForm.vue";
import AddressList from "./components/AddressList.vue";
import Alert from "./components/Alert.vue";
import Home from "./components/Home.vue";
import Modal from "./components/Modal.vue";
import ModalDelete from "./components/ModalDelete.vue";
import ModalEdit from "./components/ModalEdit.vue";
import Paginate from "./components/Paginate.vue";

app.component("Address", Address);
app.component("AddressForm", AddressForm);
app.component("AddressList", AddressList);
app.component("Alert", Alert);
app.component("Home", Home);
app.component("Modal", Modal);
app.component("ModalDelete", ModalDelete);
app.component("ModalEdit", ModalEdit);
app.component("Paginate", Paginate);

app.mount("#app");
