Vue.component('modal',{ //modal
    template:`
        <transition
                
                <div class="modal is-active" >
                    <div class="modal-card border border border-secondary">
                        <div class="modal-card-head text-center bg-dark">
                            <div class="modal-card-title text-white">
                                <slot name="head"></slot>
                            </div>
                            <button class="delete" @click="$emit('close')"></button>
                        </div>
                        <div class="modal-card-body">                           
                            <slot name="body"></slot>                           
                        </div>
                        <div class="modal-card-foot" >
                            <slot name="foot"></slot>
                        </div>
                    </div>
                </div>
        </transition>
    `
})