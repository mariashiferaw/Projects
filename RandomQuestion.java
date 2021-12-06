import java.util.Random;

public class RandomQuestion {
    private int currentAnswer;
    private int currentInt1;
    private int currentInt2;

    public void generateQuestion(){
        Random random = new Random();
        this.currentInt1 = random.nextInt(999);
        this.currentInt2 = random.nextInt(999);
        this.currentAnswer = currentInt1 + currentInt2;
    }

    public int getCurrentInt1(){
	return this.currentInt1;
    }

    public int getCurrentInt2(){
        return this.currentInt2;
    }

    public RandomQuestion() {
        this.generateQuestion();
    }
}
