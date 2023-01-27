<template>
    <div class="my-2">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapse-skill-' + name" aria-expanded="false" :aria-controls="'collapse-skill-' + name">
                    <div v-if="form.skill">
                        <span class="fw-bold">{{ form.skill }}</span>
                        <div v-if="startDate && endDate">
                            <span>{{ startDate }} - {{ endDate }}</span>
                        </div>
                    </div>
                    <div v-else>
                        <span class="fw-bold">(Not specified)</span>
                    </div>
                </button>
            </h2>
            <div :id="'collapse-skill-' + name" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFormSkill">
                <div class="accordion-body">
                    <form @submit.prevent="handleSubmit">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="skillInput" class="form-label">Skill</label>
                                    <input
                                        type="text"
                                        class="form-control bg-white"
                                        id="skillInput"
                                        v-model="form.skill"
                                        :readonly="isReadonly">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="levelInput" class="form-label">Level</label>
                                    <input
                                        type="text"
                                        class="form-control bg-white"
                                        id="levelInput"
                                        v-model="form.level"
                                        :readonly="isReadonly">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button v-if="isReadonly" class="btn btn-danger" @click.prevent="handleDelete">Delete</button>
                                <button v-else class="btn btn-primary" type="submit">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .ck-editor__editable {
        min-height: 150px;
    }
</style>
<script>
    import { ref } from 'vue';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        props: {
            profileId: Number,
            id: Number,
            name: Number,
            skill: String,
            level: String,
        },
        data() {
            return {
                isReadonly: false,
                form: {
                    id: '',
                    skill: '',
                    level: '',
                },
            };
        },
        mounted() {
            console.log('mounted');
            this.form.name = this.name;
            this.form.id = this.id;
            this.form.skill = this.skill;
            this.form.level = this.level;

            if(this.id) this.isReadonly = true;
        },
        methods: {
            handleSubmit() {
                axios.post('/api/skill/' + this.profileId, this.form)
                    .then((response) => {
                        console.log(response);
                        this.form.id = response.data.data.id;
                        this.isReadonly = true;
                        this.$emit('updateSkill', this.form);
                        this.$notify({
                            duration: 5000,
                            text: response.data.message,
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                        if(error.response.status == 422) {
                            // this.errors = error.response.data.errors
                            this.$notify({
                                duration: 5000,
                                type: 'error',
                                text: error.response.data.message,
                            });
                        }else {
                            this.$notify({
                                duration: 5000,
                                type: 'error',
                                text: error.message,
                            });
                        }
                    });
            },
            handleDelete() {
                axios.delete('/api/skill/' + this.profileId + '?id=' + this.form.id)
                    .then((response) => {
                        this.$emit('deleteSkill', this.name);
                        this.$notify({
                            duration: 5000,
                            text: response.data.message,
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                        if(error.response.status == 422) {
                            // this.errors = error.response.data.errors
                            this.$notify({
                                duration: 5000,
                                type: 'error',
                                text: error.response.data.message,
                            });
                        }else {
                            this.$notify({
                                duration: 5000,
                                type: 'error',
                                text: error.message,
                            });
                        }
                    });
            },
        }
    }
</script>
