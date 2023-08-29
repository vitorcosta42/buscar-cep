<script>
import axios from "axios";

export default {
    props: ["getAddresses","isLoading"],
    data() {
        return {
            urlBase: "/api/endereco",
            transacaoStatus: "",
            transacaoDetalhes: {},
            zipcode: "",
            ddd: "",
            state: "",
            city: "",
            neighborhood: "",
            street: "",
        };
    },
    methods: {
        searchZipcode() {
            const cep = this.zipcode;
            const apiUrl = `/api/buscar-cep/${cep}`;
            axios
                .get(apiUrl)
                .then((response) => {
                    this.ddd = response.data.ddd;
                    this.state = response.data.uf;
                    this.city = response.data.localidade;
                    if (response.data.neighborhood) {
                        this.neighborhood = response.data.bairro;
                    }
                    if (response.data.street) {
                        this.street = response.data.logradouro;
                    }
                })
                .catch((error) => {
                    console.error("Erro ao buscar o CEP", error);
                });
        },
        saveAddress() {
            let formData = new FormData();
            formData.append("zipcode", this.zipcode);
            formData.append("ddd", this.ddd);
            formData.append("state", this.state);
            formData.append("city", this.city);
            formData.append("neighborhood", this.neighborhood);
            formData.append("street", this.street);

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
                    this.getAddresses();
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
        <div class="w-100 m-auto justify-content-center text-center">
            <div class="px-5 pt-5 pb-4 d-flex gap-5 justify-content-center">
                <div class="w-100">
                    <label
                        for="InputZipcode"
                        class="form-label text-success fs-5 fw-bold"
                        >CEP</label
                    >
                    <input
                        class="form-control"
                        id="InputZipcode"
                        v-model="zipcode"
                        aria-describedby="zipcodeHelp"
                        @blur="searchZipcode"
                    />
                    <div class="mt-2" v-if="transacaoDetalhes?.dados?.zipcode">
                        <span
                            class="text-danger"
                            v-for="fieldError in transacaoDetalhes.dados
                                .zipcode"
                            :key="fieldError"
                        >
                            {{ fieldError }}
                        </span>
                    </div>
                </div>
                <div class="w-100">
                    <label
                        for="InputDDD"
                        class="form-label text-success fs-5 fw-bold"
                        >DDD</label
                    >
                    <input
                        class="form-control"
                        id="InputDDD"
                        v-model="ddd"
                        aria-describedby="dddHelp"
                    />
                    <div class="mt-2" v-if="transacaoDetalhes?.dados?.ddd">
                        <span
                            class="text-danger"
                            v-for="fieldError in transacaoDetalhes.dados.ddd"
                            :key="fieldError"
                        >
                            {{ fieldError }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="px-5 pb-4 d-flex gap-5 justify-content-center">
                <div class="w-100">
                    <label
                        for="InputState"
                        class="form-label text-success fs-5 fw-bold"
                        >Estado</label
                    >
                    <input
                        class="form-control"
                        id="InputState"
                        v-model="state"
                        aria-describedby="stateHelp"
                    />
                    <div class="mt-2" v-if="transacaoDetalhes?.dados?.state">
                        <span
                            class="text-danger"
                            v-for="fieldError in transacaoDetalhes.dados.state"
                            :key="fieldError"
                        >
                            {{ fieldError }}
                        </span>
                    </div>
                </div>
                <div class="w-100">
                    <label
                        for="InputCity"
                        class="form-label text-success fs-5 fw-bold"
                        >Cidade</label
                    >
                    <input
                        class="form-control"
                        id="InputCity"
                        v-model="city"
                        aria-describedby="cityHelp"
                    />
                    <div class="mt-2" v-if="transacaoDetalhes?.dados?.city">
                        <span
                            class="text-danger"
                            v-for="fieldError in transacaoDetalhes.dados.city"
                            :key="fieldError"
                        >
                            {{ fieldError }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="px-5 pb-5 d-flex gap-5 justify-content-center">
                <div class="w-100">
                    <label
                        for="InputNeighborhood"
                        class="form-label text-success fs-5 fw-bold"
                        >Bairro</label
                    >
                    <input
                        class="form-control"
                        id="InputNeighborhood"
                        v-model="neighborhood"
                        aria-describedby="neighborhoodHelp"
                    />
                </div>
                <div class="w-100">
                    <label
                        for="InputStreet"
                        class="form-label text-success fs-5 fw-bold"
                        >Rua</label
                    >
                    <input
                        class="form-control"
                        id="InputStreet"
                        v-model="street"
                        aria-describedby="streetHelp"
                    />
                </div>
            </div>
        </div>
    </form>
    <div class="card-footer d-flex text-light align-items-center">
        <div v-if="transacaoStatus == 'adicionado'" class="text-success">
            Endereço cadastrado com sucesso!
        </div>
        <div v-if="transacaoStatus == 'erro'" class="text-danger">
            Ocorreu um erro ao cadastrar o endereço.
        </div>
        <div class="text-center ms-auto">
            <button type="submit" class="btn btn-success" @click="saveAddress">
                Salvar Endereço
            </button>
        </div>
    </div>
</template>
