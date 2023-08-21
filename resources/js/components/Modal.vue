<script>
export default {
    props: ["id", "titulo"],
};
</script>
<template>
    <div>
        <div
            class="modal fade"
            :id="id"
            tabindex="-1"
            aria-labelledby="ModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-success  fw-bold" id="ModalLabel">
                            {{ titulo }}
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                        </button>
                    </div>
                    <div class="modal-body">
                        <slot name="alerts"></slot>
                    <slot name="content"></slot>
                </div>
                <div class="modal-footer">
                   <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
