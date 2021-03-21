<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-12 mb-5 p-0">
                    <h6 class="form mb-4 mt-4">Establishments</h6>

                    <div class="accordion mb-3" id="accordionFaq"  role="tablist">
                        <div v-for="(establishment, index) in establishments" :key="index">
                            <b-card no-body class="card mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button block v-b-toggle="'accordion-'+ index" variant="btn-primary" class="btn btn-link btn-block grey">
                                    <i class="bi bi-arrow-right bs-icon-size"></i>
                                    {{ establishment.business_name }}
                                    </b-button>
                            </b-card-header>
                            <b-collapse :id="'accordion-'+ index" visible accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <b-card-text>{{ establishment.rating_value }} </b-card-text>
                                </b-card-body>
                            </b-collapse>
                            </b-card>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</template>
<script>
export default {
    props: ['establishments'],
    data(){
        return {
            // establishments: '',
        }
    },
    mounted() {
    },
    methods: {
        // runSearch(e){
        //     // console.log(e.currentTarget.value)

        //     let formData = new FormData()
        //     formData.append('search', this.search);

        //     // console.log(formData)

        //     axios.post(this.route,
        //         formData,
        //         {
        //             headers: {
        //                 // 'Authorization': 'Bearer ' + this.apiToken
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

