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
            <div class="col-md-8">
                <div class="card">
                    <SearchForm :errors="$errors"></SearchForm>

                </div>
            </div>
        </div>
    </div>
</template>
