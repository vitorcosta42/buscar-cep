<script>
import axios from "axios";

export default {
    data() {
        return {
            urlBase: "/api/salvar",
            appData: {
                zipcode: "",
                ddd: "",
                state: "",
                city: "",
                neighborhood: "",
                street: "",
            },
        };
    },
    methods: {
        searchZipcode() {
            const cep = this.appData.zipcode;
            const apiUrl = `/api/buscar-cep/${cep}`;
            axios
                .get(apiUrl)
                .then((response) => {
                    this.appData.ddd = response.data.ddd;
                    this.appData.state = response.data.uf;
                    this.appData.city = response.data.localidade;
                    this.appData.neighborhood = response.data.bairro;
                    this.appData.street = response.data.logradouro;
                })
                .catch((error) => {
                    console.error("Erro ao buscar o CEP", error);
                });
        },
        saveAddress() {
            let formData = new FormData();
            formData.append("zipcode", this.modelo_id);
            formData.append("ddd", this.appData.ddd);
            formData.append("state", this.appData.city);
            formData.append("city", this.appData.city);
            formData.append("street", this.appData.street);
            formData.append("neighborhood", this.appData.neighborhood);

            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            axios
                .post(this.urlBase, formData, config)
                .then((response) => {
                    this.transacaoStatus = "adicionado";
                    this.transacaoDetalhes = {
                        mensagem: "ID do registro: " + response.data.id,
                    };
                })
                .catch((errors) => {
                    this.transacaoStatus = "erro";
                    this.transacaoDetalhes = {
                        mensagem: errors.response.data.message,
                        dados: errors.response.data.errors,
                    };
                });
        },
    },
};
</script>

<template>
    <div class="card-header fs-5 bg-success text-light text-center">
        Buscar CEP
    </div>
    <form>
        <div class="my-4 w-75 m-auto justify-content-center text-center">
            <div class="mb-3 d-flex gap-5 justify-content-center">
                <div>
                    <label
                        for="InputZipcode"
                        class="form-label text-success fs-5 fw-bold"
                        >CEP</label
                    >
                    <input
                        class="form-control"
                        id="InputZipcode"
                        v-model="appData.zipcode"
                        aria-describedby="zipcodeHelp"
                    />
                    <div class="mt-2" v-if="transacaoDetalhes?.dados.zipcode">
                        <ul class="list-group">
                            <li
                                class="list-group-item text-danger"
                                v-for="fieldError in transacaoDetalhes.dados
                                    .zipcode"
                                :key="fieldError"
                            >
                                {{ fieldError }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <label
                        for="InputDDD"
                        class="form-label text-success fs-5 fw-bold"
                        >DDD</label
                    >
                    <input
                        class="form-control"
                        id="InputDDD"
                        v-model="appData.ddd"
                        aria-describedby="dddHelp"
                    />
                    <div class="mt-2" v-if="transacaoDetalhes?.dados.ddd">
                        <ul class="list-group">
                            <li
                                class="list-group-item text-danger"
                                v-for="fieldError in transacaoDetalhes.dados
                                    .ddd"
                                :key="fieldError"
                            >
                                {{ fieldError }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mb-3 d-flex gap-5 justify-content-center">
                <div>
                    <label
                        for="InputState"
                        class="form-label text-success fs-5 fw-bold"
                        >Estado</label
                    >
                    <input
                        class="form-control"
                        id="InputState"
                        v-model="appData.state"
                        aria-describedby="stateHelp"
                    />
                     <div class="mt-2" v-if="transacaoDetalhes?.dados.state">
                        <ul class="list-group">
                            <li
                                class="list-group-item text-danger"
                                v-for="fieldError in transacaoDetalhes.dados
                                    .state"
                                :key="fieldError"
                            >
                                {{ fieldError }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <label
                        for="InputCity"
                        class="form-label text-success fs-5 fw-bold"
                        >Cidade</label
                    >
                    <input
                        class="form-control"
                        id="InputCity"
                        v-model="appData.city"
                        aria-describedby="cityHelp"
                    />
                    <div class="mt-2" v-if="transacaoDetalhes?.dados.city">
                        <ul class="list-group">
                            <li
                                class="list-group-item text-danger"
                                v-for="fieldError in transacaoDetalhes.dados
                                    .city"
                                :key="fieldError"
                            >
                                {{ fieldError }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mb-3 d-flex gap-5 justify-content-center">
                <div>
                    <label
                        for="InputNeighborhood"
                        class="form-label text-success fs-5 fw-bold"
                        >Bairro</label
                    >
                    <input
                        class="form-control"
                        id="InputNeighborhood"
                        v-model="appData.neighborhood"
                        aria-describedby="neighborhoodHelp"
                    />
                    <div class="mt-2" v-if="transacaoDetalhes?.dados.city">
                        <ul class="list-group">
                            <li
                                class="list-group-item text-danger"
                                v-for="fieldError in transacaoDetalhes.dados
                                    .city"
                                :key="fieldError"
                            >
                                {{ fieldError }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <label
                        for="InputStreet"
                        class="form-label text-success fs-5 fw-bold"
                        >Rua</label
                    >
                    <input
                        class="form-control"
                        id="InputStreet"
                        v-model="appData.street"
                        aria-describedby="streetHelp"
                    />
                </div>
            </div>
        </div>
    </form>
    <div class="card-footer d-flex text-light">
        <div class="text-center ms-auto">
            <button
                type="button"
                class="btn btn-success mx-3"
                @click="searchZipcode"
            >
                Buscar
            </button>
            <button type="submit" class="btn btn-success" @click="saveAddress">
                Salvar
            </button>
        </div>
    </div>
</template>
