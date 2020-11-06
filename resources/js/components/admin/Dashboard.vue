<template>
    <div>
        <v-app>
            <v-container grid-list-xs>
               
                <v-row>
                    <v-col>
                        <v-card>
                            <v-card-title>Users</v-card-title>
                            <v-card-text>
                                <h1>{{ users.length }}</h1>
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <v-col>
                        <v-card>
                            <v-card-title>Campuses</v-card-title>
                            <v-card-text>
                                <h1>{{ campuses.length }}</h1>
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <v-col>
                        <v-card>
                            <v-card-title>Programs</v-card-title>
                            <v-card-text>
                                <h1>{{ programs.length }}</h1>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
                
            </v-container>
        </v-app>
    </div>
</template>

<script>
export default {
    props : ['authUser'],
    data () {
        return {
            users : [],
            campuses : [],
            programs : [],
            config : { 
            'headers': { 
              'Authorization': 'Bearer ' + this.authUser.api_token,
              'Accept' : 'application/json',
            } 
        },
        }
    },
    created() {
        this.fetchUsers()
        this.fetchCampuses()
        this.fetchPrograms()
    },
    methods : {
        fetchUsers() {
            axios.get('/api/users', this.config)
            .then(res => this.users = res.data)
            .catch(err => console.log(err))
        },
        fetchCampuses() {
            axios.get('/api/campuses', this.config)
            .then(res => this.campuses = res.data)
            .catch(err => console.log(err))
        },
        fetchPrograms() {
            axios.get('/api/programs', this.config)
            .then(res => this.programs = res.data)
            .catch(err => console.log(err))
        },
    }
}
</script>