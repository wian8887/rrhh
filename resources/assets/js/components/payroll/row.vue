<template>
    <tr>
        <td>{{ this.cont+1 }}</td>
        <td><span type="button" class="btn btn-outline btn-link nameBox" data-toggle="tooltip" data-placement="right" data-html="true" :title="positionSalary">{{ fullName(contract) }}</span></td>
        <td>
            <input type="hidden" v-model="workedDays" :name="`contract-${contract.id}[]`" min="0" max="30" readonly>{{ workedDays }}
        </td>
        <td>
            <input type="number" v-model="unworkedDays" :name="`contract-${contract.id}[]`" class="form-control inputBox" placeholder="dias NO trabajados" min="0" :max="workedDays+unworkedDays" required>
        </td>
        <td>
            <input  style="width:5em;" type="text" class="form-control inputBox" :name="`contract-${contract.id}[]`" v-model="rcIva">
        </td>
        <td>
            <input type="text" class="form-control inputBox" :name="`contract-${contract.id}[]`" v-model="delay">
        </td>
        <td>
          <input type="text" class="form-control inputBox" :name="`contract-${contract.id}[]`" :value="previousMonth">
        </td>
        <td> {{ total | currency}} </td>
        <td> {{ totalDiscounts | currency }} </td>
        <td>{{ contract.date_start | formatDate }}</td>
        <td>{{ contract.date_end | formatDate }}</td>
    </tr>
</template>

<script>
export default {
  props:['cont','contract', 'procedure'],
  data(){
    return{
        unworkedDays: 0,
        baseWage: this.contract.base_wage,
        delay: 0,
        rcIva: 0,
        previousMonth: (this.contract.next_month_balance == null)? 0 : this.contract.next_month_balance,
        positionSalary: `Cargo: ${this.contract.position} \n<br> Haber Basico: Bs. ${this.contract.base_wage}`
    }
  },
  created(){
    //   console.log(this.contract);
  },
  methods:{
      fullName(contract){
          let name = `${contract.last_name || ''} ${contract.mothers_last_name || ''} ${contract.surname_husband || ''} ${contract.first_name || ''} ${contract.second_name || ''}  `
          name = name.replace(/\s+/gi, ' ').trim().toUpperCase();
          return name;
      },
      calculateDiscount(discount){
          return (this.quotable * discount)/100;
      },
      calculateTotalDiscountLaw(){
        return this.calculateDiscount(this.procedure.discount_old)+this.calculateDiscount(this.procedure.discount_common_risk)+this.calculateDiscount(this.procedure.discount_commission)+this.calculateDiscount(this.procedure.discount_solidary)+this.calculateDiscount(this.procedure.discount_national);
      },
  },
  computed:{
      workedDays() {
        let lastDayOfMonth = new Date(2018, this.procedure.month_id+1, 0).getDate();

        let payrollDate = {
            year: this.procedure.year,
            month: this.procedure.month_id,
        }

        let dateStart = {
            day: new Date(this.contract.date_start).getDate() + 1,
            year: new Date(this.contract.date_start).getFullYear(),
            month: new Date(this.contract.date_start).getMonth() + 1,
        }

        let dateEnd = {
            day: new Date(this.contract.date_end).getDate() + 1,
            year: new Date(this.contract.date_end).getFullYear(),
            month: new Date(this.contract.date_end).getMonth() + 1,
        }

        let workedDays = 0;

        if (this.contract.date_end == null) {
            workedDays = 30;
        } else if (dateStart.year == dateEnd.year && dateStart.month == dateEnd.month) {
            if (dateEnd.day == lastDayOfMonth && (lastDayOfMonth < 30 || lastDayOfMonth > 30)) {
                workedDays = 30 - dateStart.day;
            } else {
                workedDays = dateEnd.day - dateStart.day;
            }
            workedDays += 1;
        } else if (dateStart.year <= payrollDate.year && dateStart.month == payrollDate.month) {
            workedDays = 30 + 1 - dateStart.day;
        } else if (dateEnd.year >= payrollDate.year && dateEnd.month == payrollDate.month) {
            workedDays = dateEnd.day;
        } else if ((dateStart.year <= payrollDate.year && dateStart.month < payrollDate.month) || (dateEnd.year >= payrollDate.year && dateEnd.month > payrollDate.month)) {
            workedDays = 30;
        } else {
            workedDays = 0;
        }

        if (this.unworkedDays > workedDays) {
            return 0;
        } else {
            return (workedDays - this.unworkedDays);
        }

        return 30;
      },
      totalDiscounts(){
          return this.calculateTotalDiscountLaw() + parseFloat(this.delay || 0 );
      },
      quotable()  {
          return (this.baseWage/30) * this.workedDays;
      },
      total(){
          return this.quotable - this.totalDiscounts;
      },
      salary(){
          return this.quotable - this.calculateTotalDiscountLaw();
      }
  },
}
</script>
