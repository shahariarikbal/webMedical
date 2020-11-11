<template>
    <div class="alert msg-bg flash-message" role="alert" v-show="show">
        <strong style="color: orangered">Success!</strong> <span style="color: white">{{ body }}</span>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
export default {
    props: [ 'message' ],
    data () {
        return {
            body: '',
            show: false
        }
    },
    created () {
        if (this.message) {
            this.flash(this.message);
        }

        window.events.$on('flash', message => this.flash(message));
    },
    methods: {
        flash (message) {
            this.body = message
            this.show = true

            this.hide()
        },
        hide() {
            setTimeout(() => {
                this.show = false
            }, 3000);
        }
    }
}
</script>

<style>
.flash-message {
    position: fixed;
    right: 25px;
    bottom: 50px;
}
.msg-bg {
    background-color: #00AAFF;
}
</style>
