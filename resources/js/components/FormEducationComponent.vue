<template>
    <div class="my-2">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapse-education-' + name" aria-expanded="false" :aria-controls="'collapse-education-' + name">
                    <div v-if="form.school">
                        <span class="fw-bold">{{ form.school }}</span>
                        <div v-if="startDate && endDate">
                            <span>{{ startDate }} - {{ endDate }}</span>
                        </div>
                    </div>
                    <div v-else>
                        <span class="fw-bold">(Not specified)</span>
                    </div>
                </button>
            </h2>
            <div :id="'collapse-education-' + name" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFormEducation">
                <div class="accordion-body">
                    <form @submit.prevent="handleSubmit">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="schoolInput" class="form-label">School</label>
                                    <input
                                        type="text"
                                        class="form-control bg-white"
                                        id="schoolInput"
                                        v-model="form.school"
                                        :readonly="isReadonly">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="degreeInput" class="form-label">Degree</label>
                                    <input
                                        type="text"
                                        class="form-control bg-white"
                                        id="degreeInput"
                                        v-model="form.degree"
                                        :readonly="isReadonly">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="startInput" class="form-label">Start</label>
                                            <Datepicker v-model="form.startDate" :enable-time-picker="false" :readonly="isReadonly" auto-apply></Datepicker>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="endInput" class="form-label">End</label>
                                            <Datepicker v-model="form.endDate" :enable-time-picker="false" :readonly="isReadonly" auto-apply></Datepicker>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cityInput" class="form-label">City</label>
                                    <input
                                        type="text"
                                        class="form-control bg-white"
                                        id="cityInput"
                                        v-model="form.city"
                                        :readonly="isReadonly">
                                </div>
                            </div>
                            <div class="col-12">
                                <ckeditor
                                    :editor="editorEducation"
                                    :config="editorEducationConfig"
                                    v-model="form.description"/>
                                <small>Recruiter tip: write 200+ characters to increase interview chances</small>
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
            school: String,
            degree: String,
            startDate: String,
            endDate: String,
            city: String,
            description: String,
        },
        data() {
            return {
                editorEducation: ClassicEditor,
                editorEducationConfig: {
                    placeholder:'e.g Graduated with High Honors.'
                },
                descriptionData: '',
                isReadonly: false,
                form: {
                    id: '',
                    school: '',
                    degree: '',
                    startDate: '',
                    endDate: '',
                    city: '',
                    description: '',
                },
            };
        },
        mounted() {
            console.log('mounted');
            this.form.name = this.name;
            this.form.id = this.id;
            this.form.school = this.school;
            this.form.degree = this.degree;
            this.form.startDate = this.startDate;
            this.form.endDate = this.endDate;
            this.form.city = this.city;
            this.form.description = this.description;

            if(this.id) this.isReadonly = true;
        },
        watch: {
            // whenever question changes, this function will run
            startDatePicker(newData, oldData) {
                this.form.startDate = '1/' + newData.month + '/' + newData.year;
            },
            endDatePicker(newData, oldData) {
                this.form.endDate = '1/' + newData.month + '/' + newData.year;
            }
        },
        methods: {
            handleSubmit() {
                axios.post('/api/education/' + this.profileId, this.form)
                    .then((response) => {
                        console.log(response);
                        this.form.id = response.data.data.id;
                        this.isReadonly = true;
                        this.$emit('updateEducation', this.form);
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
                axios.delete('/api/education/' + this.profileId + '?id=' + this.form.id)
                    .then((response) => {
                        this.$emit('deleteEducation', this.name);
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
