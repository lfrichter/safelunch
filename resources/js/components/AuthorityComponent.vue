<template>
    <div class="container">
        <div class="row justify-content-center">

            <div class="row">
                <div class="col-md-12 mb-2 p-0">

                     <b-alert
                        :show="dismissCountDown"
                        dismissible
                        :variant="variant"
                        @dismissed="dismissCountDown=0"
                        @dismiss-count-down="countDownChanged"
                        >
                        {{ this.message }}
                        </b-alert>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-search-icon" id="filter-icon"><a href=""><i class="fa fa-search"></i></a></span>
                        </div>
                        <input type="search" v-model="search" v-on:keyup.enter="runSearch" placeholder="What can we help with?" class="form-control input-search">
                    </div>

                </div>
            </div>

            <establishments-component :establishments="establishments"/>
        </div>
    </div>
</template>
<script>
import EstablishmentsComponent from './EstablishmentsComponent.vue';

export default {
    props: ['route','apiToken'],
    data(){
        return {
            search: '',
            establishments: '',
            toastCount: 0,
            dismissSecs: 5,
            dismissCountDown: 0,
            message: '',
            variant: 'danger',
        }
    },
    mounted() {
    },
    methods: {
        countDownChanged(dismissCountDown) {
            this.dismissCountDown = dismissCountDown
        },
        showAlert() {
            this.dismissCountDown = this.dismissSecs
        },
        runSearch(){
            let formData = new FormData()
            formData.append('search', this.search);

            axios.post(this.route,
                formData,
                {
                    headers: {
                        // 'Authorization': 'Bearer ' + this.apiToken
                    }
                }
            ).then((response) => {
                let data = response.data
                console.log(data)
                this.establishments = data.establishments
                this.message = 'Category added with success'
                this.variant = 'success'
                this.name = ''
                this.showAlert()
                /*this.$refs['modal-category'].hide()*/
            })
            .catch((error) => {
                this.message = error.response.data.errors.name[0]
                this.variant = 'danger'
                this.showAlert()
            });
        },
        // addCategory(){
        //     let formData = new FormData()
        //     formData.append('name', this.name);
        //     formData.append('retailer_id', this.retailerId);

        //     console.log(formData)

        //     axios.post(this.route,
        //         formData,
        //         {
        //             headers: {
        //                 'Authorization': 'Bearer ' + this.apiToken
        //             }
        //         }
        //     ).then((response) => {
        //         let obj = response.data.obj
        //         this.message = 'Category added with success'
        //         this.variant = 'success'
        //         this.name = ''
        //         this.showAlert()
        //         /*this.$refs['modal-category'].hide()*/
        //     })
        //     .catch((error) => {
        //         this.message = error.response.data.errors.name[0]
        //         this.variant = 'danger'
        //         this.showAlert()
        //     });
        // },

    },
}
</script>
<style lang="css" scoped>

</style>

