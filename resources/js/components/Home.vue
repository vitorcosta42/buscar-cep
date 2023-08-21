<script>
export default {
    mounted() {
        console.log("Component mounted.");
    },
};
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <div class="card">
                    <AddressForm></AddressForm>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <AddressList></AddressList>
                </div>
            </div>
        </div>
    </div>
</template>
