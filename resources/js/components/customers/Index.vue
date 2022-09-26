<template>
    <div>
        <h3 class="text-center">Lista de Clientes</h3><br/>

        <div class="row mb-3">
            <a href="/add" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-plus"></i> Novo Cliente</a>
        </div>

        <div class="row mb-3">
            <div class="input-group">
                <input type="text" class="form-control" v-model="filter.search" placeholder="Pesquisar por Nome ou CPF"
                    aria-label="Pesquisar por Nome ou CPF" aria-describedby="button-addon4">
                <div class="input-group-append" id="button-addon4">
                    <button class="btn btn-outline-secondary" type="button" @click="findByName(filter.search)" >Pesquisar por Nome</button>
                    <button class="btn btn-outline-secondary" type="button" @click="findByCPF(filter.search)" >Pesquisar por CPF</button>
                </div>
            </div>
        </div>

        <table class="table table-bordered mb-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Nascimento</th>
                    <th>Telefone</th>
                    <th>Deletar?</th>
                </tr>
            </thead>

            <tbody>
                <tr v-if="loading">
                    <td colspan="6">
                        <div class="alert alert-info" role="alert" >Aguarde, carregando a lista de clientes...</div>
                    </td>
                </tr>
                <tr v-for="customer in customers" :key="customer.id">
                    <td>{{ customer.id }}</td>
                    <td>{{ customer.cpf }}</td>
                    <td>{{ customer.name }}</td>
                    <td>{{ customer.birthdate }}</td>
                    <td>{{ customer.phone }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-danger btn-sm" @click="deleteCustomer(customer.id)"><i class="bi bi-trash"></i> Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            customers: [],
            filter: {},
            loading: true
        }
    },
    created() {
        this.loading = true;
        this.axios
            .get('http://127.0.0.1:8989/api/customers')
            .then(response => {
                this.customers = response.data;
            })
            .finally(() => this.loading = false);
    },
    methods: {
        deleteCustomer(id) {
            if (!confirm("Deseja realmente deletar o cliente?"))
                return;
            this.loading = true;
            this.axios
                .delete(`http://127.0.0.1:8989/api/customers/${id}`)
                .then(response => {
                    let i = this.customers.map(item => item.id).indexOf(id); // find index of your object
                    this.customers.splice(i, 1)
                })
                .finally(() => this.loading = false);
        },
        findByName(search) {
            this.loading = true;
            this.axios
                .get(`http://127.0.0.1:8989/api/customers/findBy?name=${search}`)
                .then(response => {
                    this.customers = response.data;
                })
                .finally(() => this.loading = false);
        },
        findByCPF(search) {
            this.loading = true;
            this.axios
                .get(`http://127.0.0.1:8989/api/customers/findBy?cpf=${search}`)
                .then(response => {
                    this.customers = response.data;
                })
                .finally(() => this.loading = false);
        },
    }
}
</script>
