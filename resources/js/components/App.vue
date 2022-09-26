<template>
    <div class="container">


        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">Home</router-link>
                </div>
            </div>
            <div class="text-center" style="margin: 20px 0px 20px 0px;">
                <span class="text-secondary">CUCO HEATH - Gerenciador de Clientes</span>
            </div>
        </nav>
        <br />
        <router-view></router-view>
    </div>
</template>

<script>
export default {}
</script>
