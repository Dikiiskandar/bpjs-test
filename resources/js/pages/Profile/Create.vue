<template>
    <div class="container mb-5">
        <div class="card p-3 mb-3">
            <h2>Personal Details</h2>
            <form @submit.prevent="handleSubmit">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="wantedJobTitleInput" class="form-label">Wanted Job Title</label>
                        <input type="text" class="form-control" v-model="form.wantedJobTitle" id="wantedJobTitleInput">
                        <div class="d-block invalid-feedback" v-if="errors.wantedJobTitle">{{ errors.wantedJobTitle[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="row d-flex align-items-center">
                            <img v-if="previewImage" :src="previewImage" style="max-width:100px;">
                            <div class="col">
                                <label for="photoInput" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="photoInput" @change="handleImage">
                                <div class="d-block invalid-feedback" v-if="errors.file">{{ errors.file[0] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 mb-3">
                        <label for="firstNameInput" class="form-label">First Name</label>
                        <input type="text" class="form-control" v-model="form.firstName" id="firstNameInput">
                        <div class="d-block invalid-feedback" v-if="errors.firstName">{{ errors.firstName[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastNameInput" class="form-label">Last Name</label>
                        <input type="text" class="form-control" v-model="form.lastName" id="lastNameInput">
                        <div class="d-block invalid-feedback" v-if="errors.lastName">{{ errors.lastName[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="emailInput" class="form-label">Email</label>
                        <input type="email" class="form-control" v-model="form.email" id="emailInput">
                        <div class="d-block invalid-feedback" v-if="errors.email">{{ errors.email[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phoneInput" class="form-label">Phone</label>
                        <input type="text" class="form-control" v-model="form.phone" id="phoneInput">
                        <div class="d-block invalid-feedback" v-if="errors.phone">{{ errors.phone[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="countryInput" class="form-label">Country</label>
                        <input type="text" class="form-control" v-model="form.country" id="countryInput">
                        <div class="d-block invalid-feedback" v-if="errors.country">{{ errors.country[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cityInput" class="form-label">City</label>
                        <input type="text" class="form-control" v-model="form.city" id="cityInput">
                        <div class="d-block invalid-feedback" v-if="errors.city">{{ errors.city[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="addressInput" class="form-label">Address</label>
                        <input type="text" class="form-control" v-model="form.address" id="addressInput">
                        <div class="d-block invalid-feedback" v-if="errors.address">{{ errors.address[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="postalCodeInput" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" v-model="form.postalCode" id="postalCodeInput">
                        <div class="d-block invalid-feedback" v-if="errors.postalCode">{{ errors.postalCode[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="drivingLicenseInput" class="form-label">Driving License</label>
                        <input type="text" class="form-control" v-model="form.drivingLicense" id="drivingLicenseInput">
                        <div class="d-block invalid-feedback" v-if="errors.drivingLicense">{{ errors.drivingLicense[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nationalityInput" class="form-label">Nationality</label>
                        <input type="text" class="form-control" v-model="form.nationality" id="nationalityInput">
                        <div class="d-block invalid-feedback" v-if="errors.nationality">{{ errors.nationality[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="placeOfBirthInput" class="form-label">Place Of Birth</label>
                        <input type="text" class="form-control" v-model="form.placeOfBirth" id="placeOfBirthInput">
                        <div class="d-block invalid-feedback" v-if="errors.placeOfBirth">{{ errors.placeOfBirth[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dateOfBirthInput" class="form-label">Date Of Birth</label>
                        <Datepicker v-model="form.dateOfBirth" :enable-time-picker="false" auto-apply></Datepicker>
                        <div class="d-block invalid-feedback" v-if="errors.dateOfBirth">{{ errors.dateOfBirth[0] }}</div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        data() {
            return {
                editor: ClassicEditor,
                editorData: '',
                editorConfig: {},
                form: {},
                file: null,
                previewImage: null,
                errors: {},
            };
        },
        methods: {
            handleSubmit() {
                axios.post('/api/profile', this.form)
                    .then((response) => {
                        const data = response.data.data
                        this.$notify({
                            duration: 5000,
                            text: response.data.message,
                        });
                        this.$router.push({ name: 'profile.update', params: { id: data.id } });
                    })
                    .catch((error) => {
                        if(error.response.status == 422) {
                            this.errors = error.response.data.errors
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
