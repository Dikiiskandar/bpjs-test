<template>
    <div class="container mb-5">
        <div class="card p-3 mb-3">
            <h2>Personal Details</h2>
            <form @submit.prevent="handleSubmitPersonal">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="wantedJobTitleInput" class="form-label">Wanted Job Title <span class="text-primary"><i class="fa fa-question-circle-o" aria-hidden="true"></i></span></label>
                        <input type="text" class="form-control bg-white" v-model="form.personal.wantedJobTitle" id="wantedJobTitleInput">
                        <div class="d-block invalid-feedback" v-if="errors.wantedJobTitle">{{ errors.wantedJobTitle[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="row d-flex align-items-center">
                            <img v-if="previewImage" :src="previewImage" style="max-width:130px; max-height:90px;">
                            <div class="col">
                                <label for="photoInput" class="form-label">Photo</label>
                                <input type="file" class="form-control bg-white" id="photoInput" @change="handleImage">
                                <div class="d-block invalid-feedback" v-if="errors.file">{{ errors.file[0] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 mb-3">
                        <label for="firstNameInput" class="form-label">First Name</label>
                        <input type="text" class="form-control bg-white" v-model="form.personal.firstName" id="firstNameInput">
                        <div class="d-block invalid-feedback" v-if="errors.firstName">{{ errors.firstName[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastNameInput" class="form-label">Last Name</label>
                        <input type="text" class="form-control bg-white" v-model="form.personal.lastName" id="lastNameInput">
                        <div class="d-block invalid-feedback" v-if="errors.lastName">{{ errors.lastName[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="emailInput" class="form-label">Email</label>
                        <input type="email" class="form-control bg-white" v-model="form.personal.email" id="emailInput">
                        <div class="d-block invalid-feedback" v-if="errors.email">{{ errors.email[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phoneInput" class="form-label">Phone</label>
                        <input type="text" class="form-control bg-white" v-model="form.personal.phone" id="phoneInput">
                        <div class="d-block invalid-feedback" v-if="errors.phone">{{ errors.phone[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="countryInput" class="form-label">Country</label>
                        <input type="text" class="form-control bg-white" v-model="form.personal.country" id="countryInput">
                        <div class="d-block invalid-feedback" v-if="errors.country">{{ errors.country[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cityInput" class="form-label">City</label>
                        <input type="text" class="form-control bg-white" v-model="form.personal.city" id="cityInput">
                        <div class="d-block invalid-feedback" v-if="errors.city">{{ errors.city[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="addressInput" class="form-label">Address</label>
                        <input type="text" class="form-control bg-white" v-model="form.personal.address" id="addressInput">
                        <div class="d-block invalid-feedback" v-if="errors.address">{{ errors.address[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="postalCodeInput" class="form-label">Postal Code</label>
                        <input type="text" class="form-control bg-white" v-model="form.personal.postalCode" id="postalCodeInput">
                        <div class="d-block invalid-feedback" v-if="errors.postalCode">{{ errors.postalCode[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="drivingLicenseInput" class="form-label">Driving License  <span class="text-primary"><i class="fa fa-question-circle-o" aria-hidden="true"></i></span></label>
                        <input type="text" class="form-control bg-white" v-model="form.personal.drivingLicense" id="drivingLicenseInput">
                        <div class="d-block invalid-feedback" v-if="errors.drivingLicense">{{ errors.drivingLicense[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nationalityInput" class="form-label">Nationality  <span class="text-primary"><i class="fa fa-question-circle-o" aria-hidden="true"></i></span></label>
                        <input type="text" class="form-control bg-white" v-model="form.personal.nationality" id="nationalityInput">
                        <div class="d-block invalid-feedback" v-if="errors.nationality">{{ errors.nationality[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="placeOfBirthInput" class="form-label">Place Of Birth</label>
                        <input type="text" class="form-control bg-white" v-model="form.personal.placeOfBirth" id="placeOfBirthInput">
                        <div class="d-block invalid-feedback" v-if="errors.placeOfBirth">{{ errors.placeOfBirth[0] }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dateOfBirthInput" class="form-label">Date Of Birth  <span class="text-primary"><i class="fa fa-question-circle-o" aria-hidden="true"></i></span></label>
                        <Datepicker v-model="form.personal.dateOfBirth" :enable-time-picker="false" auto-apply></Datepicker>
                        <!-- <input type="text" class="form-control bg-white" v-model="form.personal.dateOfBirth" id="dateOfBirthInput"> -->
                        <div class="d-block invalid-feedback" v-if="errors.dateOfBirth">{{ errors.dateOfBirth[0] }}</div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card p-3 mb-3">
            <h2>Professional Summary</h2>
            <p>Write 2-3 short & energetic sentences to interest the reader! Mention your role. experience & most importantly - your biggest achievements best qualities and skills.</p>
            <form @submit.prevent="handleSubmitWorkingExperience">
                <div class="row">
                    <div class="col-12 mb-3">
                        <ckeditor :editor="editor" v-model="form.workingExperience" :config="editorConfig"></ckeditor>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card p-3 mb-3">
            <h1>Employement History</h1>
            <p>Show your relevant experience (last 10 years). Use bullet points to note your achievements, if possible - use numbers/facts (Achieved X, measured by Y, by doing Z)</p>
            <div class="accordion" id="accordionFormEmployement">
                <div v-for="(item, index) in form.employements" :key="item.id">
                    <form-employment-component
                        :name="index"
                        v-model:profileId="id"
                        v-model:id="item.id"
                        v-model:job-title="item.jobTitle"
                        v-model:employer="item.employer"
                        v-model:start-date="item.startDate"
                        v-model:end-date="item.endDate"
                        v-model:city="item.city"
                        v-model:description="item.description"
                        @updateEmployement="onUpdateEmployement"
                        @deleteEmployement="onDeleteEmployement"
                        />
                </div>
            </div>
            <a href="" @click.prevent="addEmployementInput()" class="p-2 ms-2">+ Add one more employement</a>
        </div>
        <div class="card p-3 mb-3">
            <h1>Education</h1>
            <p>A varied education on your resume sums up the value that your learnings and background will bring to job</p>
            <div class="accordion" id="accordionFormEducation">
                <div v-for="(item, index) in form.educations" :key="item.id">
                    <form-education-component
                        :name="index"
                        v-model:profileId="id"
                        v-model:id="item.id"
                        v-model:school="item.school"
                        v-model:degree="item.degree"
                        v-model:start-date="item.startDate"
                        v-model:end-date="item.endDate"
                        v-model:city="item.city"
                        v-model:description="item.description"
                        @updateEducation="onUpdateEducation"
                        @deleteEducation="onDeleteEducation"
                        />
                </div>
            </div>
            <a href="" @click.prevent="addEducationInput()" class="p-2 ms-2">+ Add one more education</a>
        </div>
        <div class="card p-3 mb-3">
            <h1>Skill</h1>
            <p>Choose 5 of the most important skills to show your talent! Make sure they match the keywords of the job listing if applying via an online system</p>
            <div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Don't show experience level</label>
                </div>
            </div>
            <div class="accordion" id="accordionFormSkill">
                <div v-for="(item, index) in form.skills" :key="item.id">
                    <form-skill-component
                        :name="index"
                        v-model:profileId="id"
                        v-model:id="item.id"
                        v-model:skill="item.skill"
                        v-model:level="item.level"
                        @updateSkill="onUpdateSkill"
                        @deleteSkill="onDeleteSkill"
                        />
                </div>
            </div>
            <a href="" @click.prevent="addSkillInput()" class="p-2 ms-2">+ Add one more education</a>
        </div>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        data() {
            return {
                editor: ClassicEditor,
                editorConfig: {
                    placeholder:'e.g Passionate science teacher with *+ years of experience and a track record of ...',

                },
                id: '',
                form: {
                    personal: {},
                    workingExperience: '',
                    employements: [],
                    educations: [],
                    skills: [],
                },
                file: null,
                previewImage: null,
                errors: {},
            };
        },
        mounted() {
            const id = this.$route.params.id;
            this.id = id;
            this.getProfile(id);
            this.getWorkingExperience(id);
            this.getEmployement(id);
            this.getEducation(id);
            this.getSkill(id);
            console.log(id)
        },
        methods: {
            getProfile(id) {
                axios.get('/api/profile/' + id)
                    .then((response) => {
                        const data = response.data.data
                        this.id = data.id;
                        this.form.personal = data;
                        this.previewImage = data.photoUrl;
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },
            getWorkingExperience(id) {
                axios.get('/api/working-experience/' + id)
                    .then((response) => {
                        const data = response.data.data
                        this.form.workingExperience = data.workingExperience;
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },
            getEmployement(id) {
                axios.get('/api/employment/' + id)
                    .then((response) => {
                        const data = response.data.data
                        console.log(data);
                        this.form.employements = data.employements;
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },
            getEducation(id) {
                axios.get('/api/education/' + id)
                    .then((response) => {
                        const data = response.data.data
                        console.log(data);
                        this.form.educations = data.educations;
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },
            getSkill(id) {
                axios.get('/api/skill/' + id)
                    .then((response) => {
                        const data = response.data.data
                        console.log(data);
                        this.form.skills = data.skills;
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },
            handleSubmitPersonal() {
                axios.put('/api/profile/' + this.id, this.form.personal)
                    .then((response) => {
                        this.$notify({
                            duration: 5000,
                            text: response.data.message,
                        });
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
            handleSubmitWorkingExperience() {
                axios.put('/api/working-experience/' + this.id, {workingExperience: this.form.workingExperience})
                    .then((response) => {
                        this.$notify({
                            duration: 5000,
                            text: response.data.message,
                        });
                    })
                    .catch((error) => {
                        console.log(error);
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
            uploadImage() {
                axios.put('/api/photo/' + this.id, {base64img: this.file})
                    .then((response) => {
                        console.log(response)
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },
            addEmployementInput() {
                this.form.employements.push({});
            },
            onUpdateEmployement(value) {
                this.getEmployement(this.id);
                // this.form.employements.splice(value.name, 1);
                // this.form.employements.push({
                //     name: value.name,
                //     id: value.id,
                //     jobTitle: value.jobTitle,
                //     employer: value.employer,
                //     degree: value.degree,
                //     city: value.city,
                //     description: value.description,
                // });
            },
            onDeleteEmployement(value) {
                this.getEmployement(this.id);
                // this.form.employements.splice(value, 1);
            },
            addEducationInput() {
                this.form.educations.push({});
            },
            onUpdateEducation(value) {
                this.getEducation(this.id);
                // this.form.educations.splice(value.name, 1);
                // this.form.educations.push({
                //     name: value.name,
                //     id: value.id,
                //     school: value.school,
                //     degree: value.degree,
                //     city: value.city,
                //     description: value.description,
                // });
            },
            onDeleteEducation(value) {
                this.getEducation(this.id);
                // this.form.educations.splice(0, 1);
            },
            addSkillInput() {
                this.form.skills.push({});
            },
            onUpdateSkill(value) {
                this.getSkill(this.id);
            },
            onDeleteSkill(value) {
                this.getSkill(this.id);
            },
            handleImage(e) {
                const file = e.target.files[0];
                this.previewImage = URL.createObjectURL(file);
                this.createBase64Image(file);

            },
            createBase64Image(fileObject) {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.file = e.target.result;
                    this.uploadImage();
                };
                reader.readAsDataURL(fileObject);
            },
        }
    }
</script>
