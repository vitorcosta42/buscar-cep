<script>
export default {
    props: ["addresses", "getAddresses", "paginate","isLoading"],
    data() {
        return {
            processStatus: "",
            processDetalhes: {},
        };
    },
    methods: {
        setStore(obj) {
            this.$store.state.process.status = "";
            this.$store.state.process.message = "";
            this.$store.state.process.data = "";
            this.$store.state.item = obj;
        },
    },
};
</script>

<template>
    <div class="card-header fs-5 bg-success text-light text-center">
        Listagem de Endereços
    </div>
    <div v-if="isLoading" class="d-flex justify-content-center">
        <div class="spinner-border text-success m-3" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div v-else class="table-responsive">
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
                <tr v-for="(obj, key) in addresses.data" :key="key">
                    <template v-for="(value, valueKey) in obj">
                        <template
                            v-if="
                                valueKey !== 'created_at' &&
                                valueKey !== 'updated_at'
                            "
                        >
                            <td :key="valueKey" class="align-middle">
                                <div
                                    class="d-flex justify-content-center text-center"
                                >
                                    {{ value }}
                                </div>
                            </td>
                        </template>
                    </template>
                    <td class="align-middle">
                        <div
                            class="d-flex justify-content-center text-center gap-2"
                        >
                            <button
                                class="btn btn-outline-success btn-sm rounded"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEdit"
                                @click="setStore(obj)"
                                >
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
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-end px-4">
            <Paginate>
                <li
                    v-for="(l, key) in addresses.links"
                    :key="key"
                    @click="paginate(l)"
                >
                    <a
                        class="page-link text-success"
                        v-if="l.label.match(/Previous/) !== null"
                        v-html="'Anterior'"
                    ></a>
                    <a
                        class="page-link text-success"
                        v-else-if="l.label.match(/Next/) !== null"
                        v-html="'Próximo'"
                    ></a>
                    <a
                        :class="l.active ? 'bg-success text-light' : ''"
                        class="page-link text-success"
                        v-else
                        v-html="l.label"
                    ></a>
                </li>
            </Paginate>
        </div>
    </div>
    <ModalEdit
        :getAddresses="getAddresses"
    ></ModalEdit>
    <ModalDelete
        :getAddresses="getAddresses"
    ></ModalDelete>
</template>
