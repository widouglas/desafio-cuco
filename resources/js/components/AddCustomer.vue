<template>
    <div>
        <h3 class="text-center">Novo Cliente</h3>

        <div v-if="loading">Loading...</div>

        <div class="row">
            <div class="col-md-6">
                <div v-if="errors">{{ errors }}</div>

                <form @submit.prevent="addCustomer">
                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" class="form-control" :rules="{ required: true }" v-model="customer.cpf">
                    </div>

                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" :rules="{ required: true }" v-model="customer.name">
                    </div>

                    <div class="form-group">
                        <label>Nascimento</label>
                        <input type="date" class="form-control" :rules="{ required: true }" v-model="customer.birthdate">
                    </div>

                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" class="form-control" v-model="customer.phone">
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Cliente</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                customer: {},
                errors: {},
                loading: false
            }
        },
        methods: {
            addCustomer() {
                this.loading = true
                this.axios
                    .post('http://127.0.0.1:8989/api/customers', this.customer)
                    .then(response => (
                        this.$router.push({name: 'home'})
                    ))
                    .catch(error => (
                        this.errors = error
                    ))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>
