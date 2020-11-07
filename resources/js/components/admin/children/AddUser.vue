<template>
  <v-row justify="center">

    <v-dialog
      v-model="dialog"
      max-width="400"
      persistent
    >
      <v-card>
         <v-card>
        <v-card-title class="headline">User</v-card-title>

        <v-card-text>

            <v-text-field
                name="name"
                label="Name *"
                v-model="user.name"
                prepend-icon="mdi-account"
                :error="error.name ? true : false"
                :error-messages="error.name"
            ></v-text-field> 

            <v-text-field
                type="email"
                name="email"
                label="Email *"
                v-model="user.email"
                prepend-icon="mdi-email"
                :error="error.email ? true : false"
                :error-messages="error.email"
            ></v-text-field> 

            <v-select
                :items="roles"
                :label="!edit ? 'Select Role' : user.role"
                dense
                v-model="user.role"
                prepend-icon="mdi-account-group"
                :error="error.role ? true : false"
                :error-messages="error.role"
            ></v-select>

            <v-text-field
                v-show="!edit"
                :type="hide ? 'password' : '' "
                name="password"
                label="Password *"
                prepend-icon="mdi-account"
                :append-icon="hide ? 'mdi-eye-off' : 'mdi-eye'"
                @click:append="hide = !hide"
                v-model="user.password"
                :error="error.password ? true : false"
                :error-messages="error.password"
            ></v-text-field> 

        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="green darken-1"
            text
            @click="hideDialog()"
          >
            Close
          </v-btn>

          <v-btn
            color="green darken-1"
            text
            @click="!edit ? registerUser() : updateUser()"
          >
            Register
          </v-btn>
        </v-card-actions>
        
      </v-card>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
  export default {
    props : ['showDialog', 'authUser', 'user1', 'edit'],
    data () {
      return {

        hide : true,
        roles : ['Admin', 'Accreditor', 'Quality Assurance'],
        users : [],
        user2 : {
            name : '',
            email : '',
            role : '',
            password : ''
        },
        error : {
          'name' : '',
          'email' : '',
          'role' : '',
          'password' : ''
        },
        config : { 
          'headers': { 
            'Authorization': 'Bearer ' + this.authUser.api_token,
            'Accept' : 'application/json',
          } 
        },
      }
      
    },
    computed : {
      dialog() {
          if(this.showDialog) {
              return this.showDialog
          } else {
              return false
          }
      },

      user() {
        if(this.user1) {
            return this.user1
        } else {
            return user2
        }
      },
     
    },
    methods : {
        hideDialog() {
            this.user.name = ''
            this.user.email = ''
            this.user.role = ''
            this.user.password = ''
            this.error.name = ''
            this.error.email = ''
            this.error.role = ''
            this.error.password = ''
            this.$parent.$emit('hide_dialog')
        },
        registerUser() {
            axios.post('/api/users', this.user, this.config)
            .then(res => {
                this.user.name = ''
                this.user.email = ''
                this.user.role = ''
                this.user.password = ''
                this.error.name = ''
                this.error.email = ''
                this.error.role = ''
                this.error.password = ''
                this.$parent.$emit('user_added', res.data.message)  
            }).catch(err => {
                let errors = err.response.data.errors
                if(errors.name) {
                  this.error.name = errors.name.toString()
                }

                if(errors.email) {
                  this.error.email = errors.email.toString()
                }

                if(errors.role) {
                  this.error.role = errors.role.toString()
                }

                if(errors.password) {
                  this.error.password = errors.password.toString()
                }
                 
            })
        },
        updateUser() {
            axios.put('/api/users/' + this.user.id, this.user, this.config)
            .then(res => {
                this.user.name = ''
                this.user.email = ''
                this.user.role = ''
                this.user.password = ''
                this.$parent.$emit('user_updated', res.data.message)
            }).catch(err => console.log())
        }

    }
    
  }
</script>
