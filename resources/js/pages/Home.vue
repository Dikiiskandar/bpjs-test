<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <router-link to="/profile/create" class="btn btn-primary">Create Profile</router-link>
                <div class="card mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Action</th>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in users" :key="item.id">
                                <th>
                                    <router-link :to="{ name: 'profile.update', params: { id: item.id } }">Edit</router-link>
                                </th>
                                <th scope="row">{{ item.id }}</th>
                                <td>{{ item.firstName }}</td>
                                <td>{{ item.lastName }}</td>
                                <td>{{ item.email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: []
            }
        },
        mounted() {
            axios.get('/api/profile').then((response) => {
                this.users = response.data.data;
            });
        }
    }
</script>
