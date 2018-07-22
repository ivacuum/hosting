import ModelProvide from '../mixins/ModelProvide'
import ModelFieldTrans from '../mixins/ModelFieldTrans'

export default {
  mixins: [ModelFieldTrans, ModelProvide],

  data() {
    return {
      modelPlural: 'issues',
      modelSingular: 'issue',
    }
  },
}
