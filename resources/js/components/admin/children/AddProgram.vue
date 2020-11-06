<template>
  <v-row justify="center">

    <v-dialog
      v-model="dialog"
      max-width="300"
      persistent
    >
      <v-card>
         <v-card>
        <v-card-title class="headline" v-show="!edit">Program</v-card-title>
        <v-card-title class="headline" v-show="edit">Edit Program</v-card-title>

        <v-card-text>

            <v-text-field
                name="name"
                label="Name of the Program"
                id="id"
                v-model="program.name"
                :error="errorName ? true : false"
                :error-messages="errorName"
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
            @click="!edit ? addProgram() : updateProgram()"
          >
            Save
          </v-btn>
        </v-card-actions>
        
      </v-card>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
  export default {
    props : ['showDialog', 'edit', 'program1', 'authUser'],
    data () {
      return {
      
        program2 : {
            id : '',
            name : ''
        },
        errorName : '',
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

      program() {
          if(this.program1) {
              return this.program1
          } else {
              return program2
          }
      },
     
    },
    methods : {
        hideDialog() {
            this.program.name = ''
            this.errorName = ''
            this.$parent.$emit('hide_dialog')
        },
        addProgram() {
            axios.post('/api/programs', this.program, this.config)
            .then(res => {
                this.program.name = ''
                this.$parent.$emit('program_added', 'Program added successful.')
            }).catch(err => {
              this.errorName = err.response.data.errors.name.toString()
            })
        },
        updateProgram() {
            axios.put('/api/programs/' + this.program.id, this.program, this.config)
            .then(res => {
                this.program.name = ''
                this.$parent.$emit('program_added', 'Program updated successful.')
            }).catch(err => console.log())
        }
    }
    
  }
</script>
