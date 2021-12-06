import java.util.Random;
import javafx.application.Application;
import javafx.stage.Stage;
import javafx.scene.Scene;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import javafx.geometry.Pos;
import javafx.geometry.Insets;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.scene.control.Button;
import javafx.event.EventHandler;
import javafx.event.ActionEvent;

public class MathQuiz extends Application {
    private Label answerLabel;
    private Label questionLabel;
    private TextField AnswerField;
    private TextField Tip;

    private boolean doneWithQuestion;
    private RandomQuestion question;

    public static void main(String[] args) {
        launch(args);
    }

    public void printQuestion() {
	System.out.println(this.getInt1());
	System.out.println(this.getInt2());
	System.out.println(this.getAnswer());
    }
    
    public int getInt1(){
      return this.question.getCurrentInt1();
    }

    public int getInt2(){
      return this.question.getCurrentInt2();
    }

    public int getAnswer(){
      return this.getInt1() + this.getInt2();
    }

    public void start(Stage primaryStage) {
        question = new RandomQuestion();
        question.generateQuestion();
        questionLabel = new Label(String.format("%d + %d = ", this.getInt1(), this.getInt2()));

        AnswerField = new TextField();
        Tip = new TextField();

        Button submitButton = new Button("Submit");
        Button nextButton = new Button("Next");

        submitButton.setOnAction(new SubmitButtonHandler());
        nextButton.setOnAction(new NextButtonHandler());

        answerLabel = new Label();

        HBox hbox = new HBox(10, questionLabel, AnswerField);

        VBox vbox = new VBox(10, hbox, submitButton, nextButton, answerLabel);

        vbox.setAlignment(Pos.CENTER);

        vbox.setPadding(new Insets(10));

        Scene scene = new Scene(vbox);

        primaryStage.setScene(scene);

        primaryStage.setTitle("Math Quiz");

        doneWithQuestion = false;

        primaryStage.show();
    }

    class SubmitButtonHandler implements EventHandler < ActionEvent > {
        public void handle(ActionEvent event) {
            String resultText;
            int response;
            try {
                response = Integer.parseInt(AnswerField.getText());
            } catch (NumberFormatException e) {
                resultText = "Answer must be numeric.";
                answerLabel.setText(resultText);
                return;
            }
            if(response == getAnswer()) {
                resultText = "Correct!";
                doneWithQuestion = true;
            } else {
                resultText = "Incorrect. Try Again.";
            }
            answerLabel.setText(resultText);
        }
    }

    class NextButtonHandler implements EventHandler < ActionEvent > {
        public void handle(ActionEvent event) {
            String resultText;
            if(doneWithQuestion) {
                question.generateQuestion();
                questionLabel.setText(String.format("%d + %d = ", getInt1(), getInt2()));
                doneWithQuestion = false;
            } else {
                System.out.println("Doing nothing.");
            }
        }
    }
}
