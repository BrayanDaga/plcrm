<template>
     <div
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >
                <slot name="title">Title Component</slot>
                </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <slot><p>The body Component</p></slot>
          </div>
          <div class="modal-footer">
            <slot name="footer">  <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>   </slot>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
    name: 'ModalComponent',
}
</script>

<style>
</style>