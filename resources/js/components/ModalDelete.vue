<script>
import axios from "axios";
export default {
    props: ["getAddresses"],
    data() {
        return {
            urlBase: "/api/endereco",
            newAddresses: this.addresses,
        };
    },
    methods: {
        deleteAddress(id) {
            let isConfirmed = confirm(
                "Tem certeza que deseja remover esse registro?"
            );
            if (!isConfirmed) {
                return false;
            }
            let formData = new FormData();
            formData.append("_method", "delete");
            let url = this.urlBase + "/" + id;
            axios
                .post(url, formData)
                .then((response) => {
                    this.$store.state.process.status = "sucesso";
                    this.$store.state.process.message = response.data.msg;
                    this.getAddresses();
                })
                .catch((errors) => {
                    this.$store.state.process.status = "erro";
                    this.$store.state.process.message =
                        errors.response.data.erro;
                });
        },
    },
};
</script>

<template>
    <Modal id="modalDelete" titulo="Remover Endereço">
        <template v-slot:alerts>
            <Alert
                type="success"
                title="Ação realizada com sucesso"
                :details="$store.state.process"
                v-if="$store.state.process.status == 'sucesso'"
            ></Alert>

            <Alert
                type="danger"
                title="Erro no processo"
                :details="$store.state.process"
                v-if="$store.state.process.status == 'erro'"
            >
            </Alert>
        </template>
        <template v-slot:content>
            <div class="d-flex">
                <div class="p-2 text-center">
                    <label class="form-label text-success fs-5 fw-bold">
                        ID
                    </label>
                    <input
                        type="text"
                        class="form-control text-center"
                        :value="$store.state.item.id"
                        disabled
                    />
                </div>
                <div class="p-2 text-center">
                    <label class="form-label text-success fs-5 fw-bold">
                        CEP
                    </label>
                    <input
                        type="text"
                        class="form-control text-center"
                        :value="$store.state.item.zipcode"
                        disabled
                    />
                </div>
            </div>
            <div class="d-flex">
                <div class="p-2 text-center">
                    <label class="form-label text-success fs-5 fw-bold">
                        DDD
                    </label>
                    <input
                        type="text"
                        class="form-control text-center"
                        :value="$store.state.item.ddd"
                        disabled
                    />
                </div>
                <div class="p-2 text-center">
                    <label class="form-label text-success fs-5 fw-bold">
                        Estado
                    </label>
                    <input
                        type="text"
                        class="form-control text-center"
                        :value="$store.state.item.state"
                        disabled
                    />
                </div>
            </div>
            <div class="d-flex">
                <div class="p-2 text-center">
                    <label class="form-label text-success fs-5 fw-bold">
                        Cidade
                    </label>
                    <input
                        type="text"
                        class="form-control text-center"
                        :value="$store.state.item.city"
                        disabled
                    />
                </div>
                <div class="p-2 text-center">
                    <label class="form-label text-success fs-5 fw-bold">
                        Bairro
                    </label>
                    <input
                        type="text"
                        class="form-control text-center"
                        :value="$store.state.item.neighborhood"
                        disabled
                    />
                </div>
            </div>
            <div class="d-flex">
                <div class="p-2 text-center m-auto">
                    <label class="form-label text-success fs-5 fw-bold">
                        Rua
                    </label>
                    <input
                        type="text"
                        class="form-control text-center"
                        :value="$store.state.item.street"
                        disabled
                    />
                </div>
            </div>
        </template>
        <template v-slot:footer>
            <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
            >
                Fechar
            </button>
            <button
                type="button"
                class="btn btn-danger"
                data-bs-dismiss="modal"
                @click="deleteAddress($store.state.item.id)"
                v-if="$store.state.process.status != 'sucesso'"
            >
                Remover
            </button>
        </template>
    </Modal>
</template>
