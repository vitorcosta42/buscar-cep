<script>
import axios from "axios";

export default {
    components: {},
    data() {
        return {
            urlPaginate: "",
            urlBase: "/api/endereco",
            addresses: { data: [] },
            isLoading: true,
        };
    },
    methods: {

        getAddresses() {
            let url = this.urlBase + "?" + this.urlPaginate;
            axios
                .get(url)
                .then((response) => {
                    this.addresses = response.data;
                    this.isLoading = false;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        paginate(l) {
            if (l.url) {
                this.urlPaginate = l.url.split("?")[1];
                this.getAddresses();
            }
        },
    },
    mounted() {
        this.getAddresses();
    },
};
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <div class="card">
                    <AddressForm :getAddresses="getAddresses"
                   ></AddressForm>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <AddressList
                        :addresses="addresses"
                        :getAddresses="getAddresses"
                        :isLoading="isLoading"
                        :paginate="paginate"
                    ></AddressList>
                </div>
            </div>
        </div>
    </div>
</template>
