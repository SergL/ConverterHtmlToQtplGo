

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

         var DataPhysical_person = DataHtml{
    Inputs: []InputData{
          InputData{ Key: "u1379_input", Typeinput: "text", Val: "", Title: "Введите Ваше Фамилию Имя Отчество", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1380_input", Typeinput: "text", Val: "", Title: "Введите серию и номер Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1381_input", Typeinput: "text", Val: "", Title: "Введите название органа, выдавшего паспорт", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1382_input", Typeinput: "text", Val: "", Title: "Введите число выдачи Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1383_input", Typeinput: "text", Val: "", Title: "Введите Место регистрации Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1384_input", Typeinput: "text", Val: "", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1385_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1386_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1391_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
    },
    Checkboxs: []CheckboxData{
          CheckboxData{ Key: "u1450_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
    },
}
