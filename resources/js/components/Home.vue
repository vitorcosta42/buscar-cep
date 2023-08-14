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
                    <div class="card-header bg-success text-light">
                        Buscar CEP
                    </div>
                    <form>
                        <div
                            class=" mt-3 w-50 m-auto justify-content-center text-center"
                        >
                            <label for="exampleInputCep" class="form-label text-success fs-5 fw-bold"
                                >CEP</label
                            >
                            <input
                                type="number"
                                class="form-control"
                                id="exampleInputCep"
                                aria-describedby="cepHelp"
                            />
                            <div id="emailHelp" class="form-text"></div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success m-3">
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
