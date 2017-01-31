

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

         var DataPp___completed_form__15_17_ = DataHtml{
    Inputs: []InputData{
          InputData{ Key: "u1964_input", Typeinput: "text", Val: "ИВАНОВ ИВАН ИЛЬИЧ", Title: "Введите Ваше Фамилию Имя Отчество", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1965_input", Typeinput: "text", Val: "ME 900099", Title: "Введите серию и номер Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1966_input", Typeinput: "text", Val: "16.08.2013", Title: "Введите число выдачи Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1967_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1969_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u1975_input", Typeinput: "file", Val: "", Title: "Прикрепите копию Вашего паспорта", Nameinput: "", Placeholder: "",},
          InputData{ Key: "u2121_input", Typeinput: "text", Val: "3123 6543 2225", Title: "Введите Ваш Идентификационный номер налогоплательщика", Nameinput: "", Placeholder: "",},
    },
    Checkboxs: []CheckboxData{
          CheckboxData{ Key: "u2075_input", Typeinput: "checkbox", Val: "checkbox", Name: "",},
    },
}
