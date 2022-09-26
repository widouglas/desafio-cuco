<template>
    <div>
        <h3 class="text-center">Add Customer</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addCustomer">
                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" class="form-control" v-model="customer.cpf">
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="customer.name">
                    </div>

                    <div class="form-group">
                        <label>Birthdate</label>
                        <input type="date" class="form-control" v-model="customer.birthdate">
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" v-model="customer.phone">
                    </div>

                    <button type="submit" class="btn btn-primary">Add Customer</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                customer: {}
            }
        },
        methods: {
            addCustomer() {
                this.axios
                    .post('http://127.0.0.1:8989/api/customers', this.customer)
                    .then(response => (
                        this.$router.push({name: 'home'})
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>
