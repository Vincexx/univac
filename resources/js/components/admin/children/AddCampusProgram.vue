<template>
  <v-row justify="center">

    <v-dialog
      v-model="dialog"
      max-width="400"
      persistent
    >
      <v-card>
         <v-card>
        <v-card-title class="headline" v-show="!edit">Program</v-card-title>
        <v-card-title class="headline" v-show="edit">Edit Program</v-card-title>

        <v-card-text>

        <v-select
            :items="programs"
            item-text="name"
            label="Select Program"
            dense
            v-model="program.name"
        ></v-select>

        <v-select
          :items="levels"
          label="Select Level"
          dense
          v-model="program.level"
        ></v-select>

        <v-menu
            v-model="menu2"
            :close-on-content-click="false"
            :nudge-right="40"
            transition="scale-transition"
            offset-y
            min-width="290px"
        >
            <template v-slot:activator="{ on, attrs }">
            <v-text-field
                v-model="date"
                label="Picker without buttons"
                
                readonly
                v-bind="attrs"
                v-on="on"
            ></v-text-field>
            </template>
            <v-date-picker v-model="program.validity" @input="menu2 = false"></v-date-picker>
        </v-menu>


        <v-text-field
            name="name"
            label="Link"
            id="id"
            v-model="program.link"
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
            @click="addProgram()"
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
    props : ['showDialog', 'campus_id', 'edit', 'campusProgram1'],
    data () {
      return {
        levels: [
            'Level I',
            'Level II',
            'Level III',
            'Level IV',
        ],
        programs : [],
        date: new Date().toISOString().substr(0, 10),
        menu: false,
        modal: false,
        menu2: false,
        program2 : {
          'campus_id' : this.campus_id,
          'name' : '',
          'level' : '',
          'validity' : new Date().toISOString().substr(0, 10),
          'link' : ''
        }
        
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
          if(this.campusProgram1) {
              return this.campusProgram1
          } else {
              return program2
          }
      },
      
    },
    created() {
        this.fetchPrograms()
    },
    methods : {
        fetchPrograms() {
            axios.get('/api/programs')
            .then(res => this.programs = res.data)
            .catch(err => console.log(err))
        },
        hideDialog() {
            this.program.name = ''
            this.program.level = ''
            this.program.validity = ''
            this.program.link = ''
            this.$parent.$emit('hideDialog')
        },
        addProgram() {
            axios.post('/api/programs-per-campuses', this.program)
            .then(res => {
                this.program.name = ''
                this.program.level = ''
                this.program.validity = ''
                this.program.link = ''
                this.$parent.$emit('programpercampus_added', 'Program added successful.')
            }).catch(err => console.log(err))
        } 
    }

  }
</script>
