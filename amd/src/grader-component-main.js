define([
    'local_customgrader/vendor-vuex',
    'local_customgrader/grader-enums',
    'local_customgrader/grader-store'
], function (Vuex, g_enums, g_store) {
    var template = `
            <div class="customgrader">
                <table v-if="students.length > 0" id="user-grades" class="table table-striped">
                    <tbody>
                        <!-- COURSE_TR -->
                        <tr class="GridViewScrollHeader" >
                            <th v-bind:colspan="additionalColumnsAtFirstLength"></th>
                            <th-course v-bind:colspan="gradeHeaderColspan"></th-course>
                        </tr>
                        <!-- END OF COURSE_TR -->
                        <!-- CATEGORIES_TRS-->
                        <tr  v-for="categoryLevel in categoryLevels" >
                            <th v-bind:colspan="additionalColumnsAtFirstLength"></th>
                            <template v-for="(element, index) in categoryLevel">
                                <th v-if="element.type==='fillerfirst'" v-bind:colspan="element.colspan"></th>
                                <th-category v-if="element.type === 'category' " v-bind:colspan="element.colspan" v-bind:element="element">
                                   
                                </th-category>
                                <td 
                                v-if="element.type === 'filler' || element.type === 'fillerlast'" 
                                v-bind:colspan="element.colspan"
                                ></td>

                            </template>
                            <th v-bind:colspan="additionalColumnsAtEndLength"></th>


                        </tr>
                        <!-- END OF CATEGORIES_TRS-->
                        <tr-items>  </tr-items>
                        <tr-grades 
                        v-for="(student, index) in students" 
                        v-bind:studentId="student.id" 
                        v-bind:studentIndex="index" 
                        :key="student.id"
                        ></tr-grades>
                    </tbody>
                </table>
                <div v-else>
                    Cargando información...
                </div>
                <div id="modals">
                    <modal-edit-category></modal-edit-category>
                    <modal-add-element></modal-add-element>
                </div>
                <v-dialog/>
            </div>
    `;
    var name = 'Main';
    var component  = {
        template: template,
        computed: {
            ...Vuex.mapState([
                'course',
                'categories',
                'additionalColumnsAtFirst',
                'additionalColumnsAtEnd'
            ]),
            ...Vuex.mapGetters([
                'categoryDepth',
                'itemsCount',
                'getCategoriesByDepth',
                'categoryLevels',
                'studentSetSorted',
                'itemLevel',
                'courseLevel'
            ]),
            additionalColumnsAtFirstLength: function () {
                return this.additionalColumnsAtFirst.length;
            },
            additionalColumnsAtEndLength: function () {
                return this.additionalColumnsAtEnd.length;
            },
            students: function() {
                return this.studentSetSorted;
            },
            gradeHeaderColspan: function () {
                return Number(this.courseLevel.colspan) + this.additionalColumnsAtFirstLength + this.additionalColumnsAtEndLength;
            }

        },
        mounted: function () {
            this.$store.dispatch(g_store.actions.FETCH_STATE);
        }
    };
   return {
      component: component,
      name: name
   }
});