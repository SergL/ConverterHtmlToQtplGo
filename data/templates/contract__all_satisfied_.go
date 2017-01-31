

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

         var DataContract__all_satisfied_ = DataHtml{
    Inputs: []InputData{
          InputData{ Key: "u1103_input", Typeinput: "text", Val: "", Title: "Введите Ваше Фамилию Имя Отчество", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1104_input", Typeinput: "text", Val: "", Title: "Введите серию и номер Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1105_input", Typeinput: "text", Val: "", Title: "Введите название органа, выдавшего паспорт", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1106_input", Typeinput: "text", Val: "", Title: "Введите число выдачи Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1107_input", Typeinput: "text", Val: "", Title: "Введите Место регистрации Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1108_input", Typeinput: "text", Val: "", Title: "Введите Ваше имя", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1126_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1127_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1217_input", Typeinput: "text", Val: "", Nameinput: "", Title: "", Placeholder: "",},
    },
    Checkboxs: []CheckboxData{
          CheckboxData{ Key: "u1124_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
    },
}
