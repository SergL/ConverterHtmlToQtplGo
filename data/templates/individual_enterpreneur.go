

//{% code
    type InputData struct {
        Key         string;
        Nameinput   string;
        Typeinput   string;
        Title       string;
        Val         string;
        Placeholder string;
    }
                    
    type TextareaData struct {
        Key         string;
        Name        string;
        Typeinput   string;
        Title       string;
        Val       string;
        Placeholder string;
    }

    type CheckboxData struct {
        Name        string;
        Key         string;
        Typeinput   string;
        Val         string;
        Title       string;
        Idx         int; 
        Checked     string;
        Events      string; 
        DataJson    string;
    }
    
    type DataHtml struct{
        Checkboxs   []CheckboxData;
        Inputs      []InputData;
        Textareas   []TextareaData;
    }
//%}



           package templates

         var DataIndividual_enterpreneur = DataHtml{
    Checkboxs: []CheckboxData{
          CheckboxData{ Key: "u4103_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
    },
    Inputs: []InputData{
          InputData{ Key: "u4177_input", Typeinput: "text", Val: "", Title: "Введите адрес регистрации Вашей организации", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4178_input", Typeinput: "text", Val: "", Title: "Введите Ваш Основной государственный регистрационный номер индивидуального предпринимателя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4179_input", Typeinput: "text", Val: "", Title: "Введите Идентификационный код банка", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4180_input", Typeinput: "text", Val: "", Title: "Введите название банка", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4181_input", Typeinput: "text", Val: "", Title: "Введите номер расчетного счета банка", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4182_input", Typeinput: "text", Val: "", Title: "Введите номер корреспондирующего счета в банке", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4183_input", Typeinput: "text", Val: "", Title: "Введите название валюты", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4184_input", Typeinput: "text", Val: "", Title: "Введите страну банка", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4193_input", Typeinput: "text", Val: "", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4194_input", Typeinput: "text", Val: "", Title: "Введите Ваше Имя Фамилию Отчество", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u4195_input", Typeinput: "text", Val: "", Title: "Введите полное название Вашей организации", Nameinput: "", Placeholder: "",},
    },
}
