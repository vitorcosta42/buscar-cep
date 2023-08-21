<script>
import axios from "axios";

export default {
    components: {},
    data() {
        return {
            urlBase: "/api/endereco",
            processStatus: "",
            processDetalhes: {},
            addresses: { data: [] },
            deleteItemId: null,
        };
    },
    methods: {
        setStore(obj) {
            this.$store.state.process.status = "";
            this.$store.state.process.message = "";
            this.$store.state.process.data = "";
            this.$store.state.item = obj;
        },
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
                    this.addresses = response.data;
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

        getAddresses() {
            let url = this.urlBase;
            axios
                .get(url)
                .then((response) => {
                    this.addresses = response.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
    },
    mounted() {
        this.getAddresses();
    },
};
</script>

<template>
    <div class="card-header fs-5 bg-success text-light text-center">
        Listagem de Endereços
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">CEP</th>
                    <th class="text-center">DDD</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Cidade</th>
                    <th class="text-center">Bairro</th>
                    <th class="text-center">Rua</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(obj, key) in addresses" :key="key">
                    <template v-for="(value, valueKey) in obj">
                        <template
                            v-if="
                                valueKey !== 'created_at' &&
                                valueKey !== 'updated_at'
                            "
                        >
                            <td :key="valueKey" class="align-middle">
                                <div
                                    class="d-flex align-items-center justify-content-center"
                                >
                                    {{ value }}
                                </div>
                            </td>
                        </template>
                    </template>
                    <td
                        class="d-flex align-items-center justify-content-center gap-2"
                    >
                        <button class="btn btn-outline-success btn-sm rounded">
                            <i class="fas fa-edit"></i>
                        </button>

                        <button
                            class="btn btn-outline-danger btn-sm rounded"
                            data-bs-toggle="modal"
                            data-bs-target="#modalDelete"
                            @click="setStore(obj)"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
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
                    <label class="form-label text-success fs-5 fw-bold"> ID </label>
                    <input
                        type="text"
                        class="form-control text-center"
                        :value="$store.state.item.id"
                        disabled
                    />
                </div>
                <div class="p-2 text-center">
                    <label class="form-label text-success fs-5 fw-bold"> CEP </label>
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
                    <label class="form-label text-success fs-5 fw-bold"> DDD </label>
                    <input
                        type="text"
                        class="form-control text-center"
                        :value="$store.state.item.ddd"
                        disabled
                    />
                </div>
                <div class="p-2 text-center">
                    <label class="form-label text-success fs-5 fw-bold"> Estado </label>
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
                    <label class="form-label text-success fs-5 fw-bold"> Cidade </label>
                    <input
                        type="text"
                        class="form-control text-center"
                        :value="$store.state.item.city"
                        disabled
                    />
                </div>
                <div class="p-2 text-center" >
                    <label class="form-label text-success fs-5 fw-bold"> Bairro </label>
                    <input
                        type="text"
                        class="form-control text-center"
                        :value="$store.state.item.neighborhood"
                        disabled
                    />
                </div>
            </div>
            <div class="d-flex"  >
                <div class="p-2 text-center m-auto" >
                    <label class="form-label text-success fs-5 fw-bold"> Rua </label>
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
    <div class="card-footer d-flex text-light align-items-center">
        <div v-if="processStatus == 'adicionado'" class="text-success">
            Endereço cadastrado com sucesso!
        </div>
        <div v-if="processStatus == 'erro'" class="text-danger">
            Ocorreu um erro ao cadastrar o endereço.
        </div>
        <div class="text-center ms-auto"></div>
    </div>
</template>
