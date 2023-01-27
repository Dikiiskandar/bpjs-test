<template>
    <div>
        <notifications />
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <header-component></header-component>
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        }
    }
</script>
