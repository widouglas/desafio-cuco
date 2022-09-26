<template>
    <div>
        <h3 class="text-center">All Customers</h3><br/>

        <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
    	    <input name="consulta" id="txt_consulta" placeholder="Consultar" type="text" class="form-control">
        </div>

        <div v-if="loading">Carregando...</div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>CPF</th>
                <th>Name</th>
                <th>Birthdate</th>
                <th>Phone</th>
                <th>Actions</th>
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                customers: []
            }
        },
        created() {
            this.axios
                .get('http://127.0.0.1:8989/api/customers')
                .then(response => {
                    this.customers = response.data;
                });
        },
        methods: {
            deleteCustomer(id) {
                this.axios
                    .delete(`http://127.0.0.1:8989/api/customers/${id}`)
                    .then(response => {
                        let i = this.customers.map(item => item.id).indexOf(id); // find index of your object
                        this.customers.splice(i, 1)
                    });
            }
        }
    }
</script>
