<template>
    <form-wizard title="Voltooi uw registratie"
                 subtitle=""
                 @on-complete="onComplete" shape="circle" color="#20a0ff" error-color="#ff4949">
        <tab-content title="Profiel" icon="ti-user" :before-change="validateFirstStep">
            <form @submit.prevent="nextButtonClick">
                <div class="md-form-group float-label">
                    <input name="name" type="text" class="md-input has-value" v-model="formData.name" required>
                    <label>Naam</label>
                    <template v-if="errors.name">
                        <span class="help-block">
                            <strong>{{errors.name[0]}}</strong>
                        </span>
                    </template>
                </div>

                <div class="md-form-group float-label">
                    <input name="username" type="text" class="md-input" v-model="formData.username" required>
                    <label>Gebruikersnaam</label>
                    <template v-if="errors.username">
                        <span class="help-block">
                            <strong>{{errors.username[0]}}</strong>
                        </span>
                    </template>
                </div>

                <!--<div class="md-form-group float-label">-->
                    <!--<input name="email" type="email" class="md-input has-value" v-model="formData.email" disabled>-->
                    <!--<label>Email</label>-->
                <!--</div>-->

                <div class="md-form-group float-label">
                    <input name="password" type="password" class="md-input" v-model="formData.password" required>
                    <label>Wachtwoord</label>
                    <template v-if="errors.password">
                        <span class="help-block">
                            <strong>{{errors.password[0]}}</strong>
                        </span>
                    </template>
                </div>

                <template v-if="errors.email">
                    <p style="color: red; margin: 0;">Er bestaat al een account met uw email adres. {{data.email}}</p>
                    U kunt uw <a href="/password/reset">wachtwoord resetten</a> of <a href="/login">inloggen</a>
                </template>

                <input type="submit" style="display: none;">
            </form>

        </tab-content>

        <tab-content title="Bedrijfsinfo" icon="ti-settings" :before-change="validateSecondStep">
            <form @submit.prevent="nextButtonClick">
                <div class="md-form-group float-label">
                    <input name="company_name" type="text" class="md-input has-value" v-model="formData.company_name" required>
                    <label>Bedrijfsnaam</label>
                    <template v-if="errors.company_name">
                        <span class="help-block">
                            <strong>{{errors.company_name[0]}}</strong>
                        </span>
                    </template>
                </div>

                <div class="md-form-group float-label">
                    <input name="city" type="text" class="md-input" v-model="formData.city" required>
                    <label>Stad</label>
                    <template v-if="errors.city">
                        <span class="help-block">
                            <strong>{{errors.city[0]}}</strong>
                        </span>
                    </template>
                </div>

                <div class="md-form-group float-label">
                    <input name="postal_code" type="text" class="md-input" v-model="formData.postal_code" required>
                    <label>Postcode</label>
                    <template v-if="errors.postal_code">
                        <span class="help-block">
                            <strong>{{errors.postal_code[0]}}</strong>
                        </span>
                    </template>
                </div>


                <div class="md-form-group float-label">
                    <input name="address" type="text" class="md-input" v-model="formData.address" required>
                    <label>Adres</label>
                    <template v-if="errors.address">
                        <span class="help-block">
                            <strong>{{errors.address[0]}}</strong>
                        </span>
                    </template>
                </div>

                <input type="submit" style="display: none;">
            </form>
        </tab-content>

        <tab-content title="Bevestiging" icon="ti-check">
            Bedankt, controleer uw gegevens en klik op voltooien wanneer u klaar bent om uw registratie te voltooien.

            <table class="w-100 table">
                <!--<tr>-->
                    <!--<th>Month</th>-->
                    <!--<th>Savings</th>-->
                <!--</tr>-->
                <tr>
                    <td>Gebruikersnaam</td>
                    <td>{{formData.username}}</td>
                </tr>
                <tr>
                    <td>Naam</td>
                    <td>{{formData.name}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{formData.email}}</td>
                </tr>
                <tr>
                    <td>Bedrijfsnaam</td>
                    <td>{{formData.company_name}}</td>
                </tr>
                <tr>
                    <td>Adres</td>
                    <td>{{formData.address}}, {{formData.postal_code}} {{formData.city}}</td>
                </tr>
            </table>
        </tab-content>

        <button style="background: #5f9dc4; color: white;" type="primary" slot="prev" class="btn btn-block p-x-md">Vorige</button>
        <button id="next-btn" style="background: #5f9dc4; color: white;" type="primary" slot="next" class="btn btn-block p-x-md">Volgende</button>
        <button style="background: #5f9dc4; color: white;" type="primary" slot="finish" class="btn btn-block p-x-md">Voltooien</button>

    </form-wizard>

</template>

<script>
    export default {
        props: ['data'],
        data() {
            return {
                emailTaken: false,
                formData: {
                    username: '',
                    name: this.data.name,
                    email: this.data.email,
                    password: '',
                    company_name: this.data.company_name,
                    city: '',
                    postal_code: '',
                    address: '',
                    confirmed: 'no',
                    token: this.data.token
                },
                errors: {}
            }
        },
        methods: {
            nextButtonClick() {
              document.getElementById('next-btn').click();
            },
            onComplete: function() {
                this.formData.confirmed = 'yes';
                console.log(this.validateThirdStep());
            },
            validateFirstStep() {
                return new Promise((resolve, reject) => {
                    resolve(this.submitData(4));
                })
            },
            validateSecondStep() {
                console.log('2nd');
                return new Promise((resolve, reject) => {
                    resolve(this.submitData(1));
                })
            },
            validateThirdStep() {
                return new Promise((resolve, reject) => {
                    resolve(this.submitData(0));
                })
            },
            submitData(maxErrors) {
                return axios.post('/api/v1/sign-up', this.formData).then( (res) => {
                    this.errors = {};

                    if (maxErrors === 0) {
                        return window.location.href = `/login?api_token=${res.data.api_token}`;
                    }
                    return true;
                }).catch( (err) => {
                    this.errors =  err.response.data.errors;

                    if (Object.keys(this.errors).length > maxErrors) {
                        return false;
                    }

                    // reset errors if no errors.
                    this.errors = {};
                    return true;
                });
            }
        }
    }
</script>

<style scoped>
    .md-form-group {
        /*padding: 18px 0 15px 0;*/
    }
    table {
        margin-top: 20px;
        table-layout: fixed;
    }
    td {
        word-wrap: break-word;
    }
</style>