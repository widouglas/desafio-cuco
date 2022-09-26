<template>
    <div>
        <h3 class="text-center">Lista de Clientes</h3><br />

        <div class="row mb-3">
            <div class="d-flex flex-row">
                <div class="input-group">
                    <div class="form-outline">
                        <input type="text" class="form-control" v-model="filter.name" placeholder="Buscar por Nome" />
                    </div>
                    <button type="button" class="btn btn-primary" @click="findByName(filter.name)">
                        Buscar
                    </button>
                </div>
            </div>

            <div class="d-flex flex-row">
                <div class="input-group">
                    <div class="form-outline">
                        <input type="text" class="form-control" v-model="filter.cpf" placeholder="Buscar por CPF" />
                    </div>
                    <button type="button" class="btn btn-primary" @click="findByCPF(filter.cpf)">
                        Buscar
                    </button>
                </div>
            </div>
        </div>

        <div v-if="loading">Loading...</div>

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
                <tr v-for="customer in customers" :key="customer.id">
                    <td>{{ customer.id }}</td>
                    <td>{{ customer.cpf }}</td>
                    <td>{{ customer.name }}</td>
                    <td>{{ customer.birthdate }}</td>
                    <td>{{ customer.phone }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-danger" @click="deleteCustomer(customer.id)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="row mb-3">
            <a href="/add" class="btn btn-primary">Novo Cliente</a>
        </div>
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
        this.axios
            .get('http://127.0.0.1:8989/api/customers')
            .then(response => {
                this.customers = response.data;
            })
            .finally(() => this.loading = false);
    },
    methods: {
        deleteCustomer(id) {
            this.axios
                .delete(`http://127.0.0.1:8989/api/customers/${id}`)
                .then(response => {
                    this.loading = true
                    let i = this.customers.map(item => item.id).indexOf(id); // find index of your object
                    this.customers.splice(i, 1)
                })
                .finally(() => this.loading = false);
        },
        findByName(name) {
            this.axios
                .get(`http://127.0.0.1:8989/api/customers/findBy?name=${name}`)
                .then(response => {
                    this.customers = response.data;
                });
        },
        findByCPF(cpf) {
            this.axios
                .get(`http://127.0.0.1:8989/api/customers/findBy?cpf=${cpf}`)
                .then(response => {
                    this.customers = response.data;
                });
        },
    }
}
</script>
