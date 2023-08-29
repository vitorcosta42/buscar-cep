<script>
import axios from "axios";
export default {
    props: ["getAddresses"],
    data() {
        return {
            urlBase: "/api/endereco",
            transacaoStatus: "",
            transacaoDetalhes: {},
            newAddresses: this.addresses,
        };
    },
    methods: {
        updateAddress() {
            let formData = new FormData();
            formData.append("_method", "patch");
            formData.append("zipcode", this.$store.state.item.zipcode);
            formData.append("ddd", this.$store.state.item.ddd);
            formData.append("state", this.$store.state.item.state);
            formData.append("city", this.$store.state.item.city);
            if (this.$store.state.item.neighborhood) {
                formData.append(
                    "neighborhood",
                    this.$store.state.item.neighborhood
                );
            } 
            else { 
                formData.append(
                    "neighborhood",
                    ""
                );
            
            }
            if (this.$store.state.item.street) {
                formData.append("street", this.$store.state.item.street);
            }else { 
                formData.append(
                    "street",
                    ""
                );
            
            }

            let url = this.urlBase + "/" + this.$store.state.item.id;

            let config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            axios
                .post(url, formData, config)
                .then((response) => {
                    this.transacaoStatus = "atualizado";
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
    <form>
        <Modal id="modalEdit" titulo="Edição de Endereço">
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
                            v-model="$store.state.item.id"
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
                            v-model="$store.state.item.zipcode"
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
                            v-model="$store.state.item.ddd"
                        />
                    </div>
                    <div class="p-2 text-center">
                        <label class="form-label text-success fs-5 fw-bold">
                            Estado
                        </label>
                        <input
                            type="text"
                            class="form-control text-center"
                            v-model="$store.state.item.state"
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
                            v-model="$store.state.item.city"
                        />
                        
                    </div>
                    <div class="p-2 text-center">
                        <label class="form-label text-success fs-5 fw-bold">
                            Bairro
                        </label>
                        <input
                            type="text"
                            class="form-control text-center"
                            v-model="$store.state.item.neighborhood"
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
                            v-model="$store.state.item.street"
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
                    class="btn btn-success"
                    data-bs-dismiss="modal"
                    @click="updateAddress($store.state.item.id)"
                >
                    Editar
                </button>
            </template>
        </Modal>
    </form>
</template>
