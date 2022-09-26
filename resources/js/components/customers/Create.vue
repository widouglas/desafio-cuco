<template>
    <div>
        <h3 class="text-center">Novo Cliente</h3>

        <div class="alert alert-info" role="alert" v-if="loading">Salvando, aguarde...</div>

        <form @submit="createCustomer">
            <div class="row">
                <div class="alert alert-danger col-md-12" role="alert" v-if="errors.length">
                    <b>Por favor, corriga os seguintes erros:</b>
                    <ul>
                        <li v-for="error in errors">{{ error }}</li>
                    </ul>
                </div>

                <div class="form-group col-md-2">
                    <label>CPF</label>
                    <input type="text" class="form-control" v-model="customer.cpf" minlength="11" maxlength="11" />
                </div>

                <div class="form-group col-md-6">
                    <label>Nome</label>
                    <input type="text" class="form-control" v-model="customer.name">
                </div>

                <div class="form-group col-md-2">
                    <label>Nascimento</label>
                    <input type="date" class="form-control" v-model="customer.birthdate">
                </div>

                <div class="form-group col-md-2">
                    <label>Telefone</label>
                    <input type="text" placeholder="(xx)xxxxx-xxxx" pattern="([0-9]{2})[0-9]{5}-[0-9]{4}"
                        class="form-control" v-model="customer.phone" minlength="14" maxlength="14">
                </div>

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary">
                        Salvar Cliente
                    </button>
                </div>
            </div>
        </form>
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
        createCustomer() {
            this.errors = [];

            if (!this.customer.cpf) {
                this.errors.push('CPF é Obrigatório.');
                return false;
            }

            if (!this.customer.name) {
                this.errors.push('Nome é Obrigatório.');
                return false;
            }

            if (!this.customer.birthdate) {
                this.errors.push('Data de Nascimento é Obrigatória.');
                return false;
            }

            this.loading = true;
            this.axios
                .post('http://127.0.0.1:8989/api/customers', this.customer)
                .then(response => (
                    this.$router.push({ name: 'home' })
                ))
                .catch(function (error) {
                    alert(error);
                })
                .finally(() => this.loading = false)
        }
    }
}
</script>
